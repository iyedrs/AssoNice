<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Discipline;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/clubs')]
class ClubController extends Controller
{
    #[Get('/', middleware: 'auth.adherent:0')]
    public function index()
    {
        $clubs = Club::with('disciplines')->get();
        return view('club.list', compact('clubs'));
    }

    #[Get('/create', middleware: 'auth.adherent:1')]
    public function create()
    {
        $disciplines = Discipline::all();
        return view('club.form', compact('disciplines'));
    }

    #[Post('/', middleware: 'auth.adherent:1')]
    public function store(Request $request)
    {
        $request->validate([
            'CLU_NOM' => 'required|string|max:255',
            'CLU_ADRESSEVILLE' => 'nullable|string|max:255',
            'CLU_ADRESSERUE' => 'nullable|string|max:255',
            'CLU_ADRESSECP' => 'nullable|string|max:10',
            'CLU_MAIL' => 'nullable|email|max:255',
            'CLU_TELFIXE' => 'nullable|string|max:20',
            'disciplines' => 'nullable|array',
            'disciplines.*' => 'integer|exists:DISCIPLINE,DIS_ID',
        ]);

        $club = Club::create($request->only([
            'CLU_NOM', 'CLU_ADRESSEVILLE', 'CLU_ADRESSERUE',
            'CLU_ADRESSECP', 'CLU_MAIL', 'CLU_TELFIXE'
        ]));

        if ($request->has('disciplines')) {
            $club->disciplines()->sync($request->disciplines);
        }

        return redirect('/clubs')->with('success', 'Club créé avec succès.');
    }

    #[Get('/{id}/edit', middleware: 'auth.adherent:1')]
    public function edit($id)
    {
        $club = Club::with('disciplines')->findOrFail($id);
        $disciplines = Discipline::all();
        return view('club.form', compact('club', 'disciplines'));
    }

    #[Post('/{id}/update', middleware: 'auth.adherent:1')]
    public function update(Request $request, $id)
    {
        $club = Club::findOrFail($id);

        $request->validate([
            'CLU_NOM' => 'required|string|max:255',
            'CLU_ADRESSEVILLE' => 'nullable|string|max:255',
            'CLU_ADRESSERUE' => 'nullable|string|max:255',
            'CLU_ADRESSECP' => 'nullable|string|max:10',
            'CLU_MAIL' => 'nullable|email|max:255',
            'CLU_TELFIXE' => 'nullable|string|max:20',
            'disciplines' => 'nullable|array',
            'disciplines.*' => 'integer|exists:DISCIPLINE,DIS_ID',
        ]);

        $club->update($request->only([
            'CLU_NOM', 'CLU_ADRESSEVILLE', 'CLU_ADRESSERUE',
            'CLU_ADRESSECP', 'CLU_MAIL', 'CLU_TELFIXE'
        ]));

        $club->disciplines()->sync($request->disciplines ?? []);

        return redirect('/clubs')->with('success', 'Club modifié avec succès.');
    }

    #[Get('/{id}/delete', middleware: 'auth.adherent:2')]
    public function destroy($id)
    {
        $club = Club::findOrFail($id);        $club->disciplines()->detach();        $club->delete();

        return redirect('/clubs')->with('success', 'Club supprimé avec succès.');
    }
}
