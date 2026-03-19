<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Models\Club;
use App\Models\Discipline;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class AdherentController extends Controller
{
    #[Get('/inscription')]
    public function inscriptionForm()
    {
        $clubs = Club::all();
        $disciplines = Discipline::all();
        return view('adherents.inscription', compact('clubs', 'disciplines'));
    }

    #[Post('/inscription')]
    public function inscription(Request $request)
    {
        $request->validate([
            'ADH_NOM' => 'required|string',
            'ADH_PRENOM' => 'required|string',
            'ADH_EMAIL' => 'required|email|unique:ADHERENT,ADH_EMAIL',
            'ADH_DDN' => 'required|date',
            'ADH_ADRESSE' => 'required|string',
            'ADH_HASH_PWD' => 'required|string|min:6',
            'CLU_ID' => 'required|integer',
            'DIS_ID' => 'required|integer',
        ]);

        Adherent::create([
            'ADH_NOM' => $request->ADH_NOM,
            'ADH_PRENOM' => $request->ADH_PRENOM,
            'ADH_DDN' => $request->ADH_DDN,
            'ADH_ADRESSE' => $request->ADH_ADRESSE,
            'ADH_HASH_PWD' => Hash::make($request->ADH_HASH_PWD),
            'ADH_EMAIL' => $request->ADH_EMAIL,
            'ADH_ROLE' => 0,
            'CLU_ID' => $request->CLU_ID,
            'DIS_ID' => $request->DIS_ID,
        ]);

        return redirect('/connexion')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }

    #[Get('/connexion')]
    public function connexionForm()
    {
        return view('adherents.connexion');
    }

    #[Post('/connexion')]
    public function connexion(Request $request)
    {
        $request->validate([
            'ADH_EMAIL' => 'required|email',
            'ADH_HASH_PWD' => 'required|string',
        ]);

        $adherent = Adherent::where('ADH_EMAIL', $request->ADH_EMAIL)->first();

        if ($adherent && Hash::check($request->ADH_HASH_PWD, $adherent->ADH_HASH_PWD)) {
            $request->session()->regenerate();
            session(['adherent' => $adherent]);
            return redirect('/')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors(['ADH_EMAIL' => 'Email ou mot de passe incorrect.']);
    }

    #[Get('/deconnexion')]
    public function deconnexion(Request $request)
    {
        $request->session()->forget('adherent');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Déconnexion réussie.');
    }

    #[Get('/admin/adherents', middleware: 'auth.adherent:2')]
    public function listeAdherents(Request $request)
    {
        $adherents = Adherent::with('role')->get();
        $roles = Role::all();
        return view('adherents.liste', compact('adherents', 'roles'));
    }

    #[Post('/admin/adherents/role', middleware: 'auth.adherent:2')]
    public function updateRole(Request $request)
    {
        $request->validate([
            'ADH_ID' => 'required|integer|exists:ADHERENT,ADH_ID',
            'ADH_ROLE' => 'required|integer|min:0|max:2',
        ]);

        $target = Adherent::find($request->ADH_ID);
        $target->ADH_ROLE = $request->ADH_ROLE;
        $target->save();

        return redirect('/admin/adherents')->with('success', 'Rôle mis à jour avec succès.');
    }

    #[Get('/admin/adherents/{id}/delete', middleware: 'auth.adherent:2')]
    public function destroy($id)
    {
        $adherent = Adherent::findOrFail($id);
        $adherent->inscription()->delete();
        $adherent->delete();

        return redirect('/admin/adherents')->with('success', 'Adhérent supprimé avec succès.');
    }
}
