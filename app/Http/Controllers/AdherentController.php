<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Models\Club;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdherentController extends Controller
{
    public function inscriptionForm()
    {
        $clubs = Club::all();
        $disciplines = Discipline::all();
        return view('adherents.inscription', compact('clubs', 'disciplines'));
    }

    public function inscription(Request $request)
    {
        $request->validate([
            'ADH_ID' => 'required|string|unique:ADHERENT,ADH_ID',
            'ADH_NOM' => 'required|string',
            'ADH_PRENOM' => 'required|string',
            'ADH_EMAIL' => 'required|email|unique:ADHERENT,ADH_EMAIL',
            'ADH_DDN' => 'required|date',
            'ADH_ADRESSE' => 'required|string',
            'ADH_HASH_PWD' => 'required|string|min:6',
            'CLU_ID' => 'required|string',
            'DIS_ID' => 'required|string',
        ]);

        Adherent::create([
            'ADH_ID' => $request->ADH_ID,
            'ADH_NOM' => $request->ADH_NOM,
            'ADH_PRENOM' => $request->ADH_PRENOM,
            'ADH_DDN' => $request->ADH_DDN,
            'ADH_ADRESSE' => $request->ADH_ADRESSE,
            'ADH_HASH_PWD' => Hash::make($request->ADH_HASH_PWD),
            'ADH_EMAIL' => $request->ADH_EMAIL,
            'ADH_ROLE' => 'adherent',
            'CLU_ID' => $request->CLU_ID,
            'DIS_ID' => $request->DIS_ID,
        ]);

        return redirect('/connexion')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }

    public function connexionForm()
    {
        return view('adherents.connexion');
    }

    public function connexion(Request $request)
    {
        $request->validate([
            'ADH_EMAIL' => 'required|email',
            'ADH_HASH_PWD' => 'required|string',
        ]);

        $adherent = Adherent::where('ADH_EMAIL', $request->ADH_EMAIL)->first();

        if ($adherent && Hash::check($request->ADH_HASH_PWD, $adherent->ADH_HASH_PWD)) {
            session(['adherent' => $adherent]);
            return redirect('/')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors(['ADH_EMAIL' => 'Email ou mot de passe incorrect.']);
    }

    public function deconnexion()
    {
        session()->forget('adherent');
        return redirect('/connexion');
    }
}
