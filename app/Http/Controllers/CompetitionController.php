<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Club;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class CompetitionController extends Controller
{
    // Afficher la liste de toutes les compétitions
    #[Get('/competitions', name: 'competitions.index')]
    public function index()
    {
        $competitions = Competition::all();
        return view('competitions.index', compact('competitions'));
    }

    // Afficher une compétition en particulier
    #[Get('/competitions/{id}', name: 'competitions.show')]
    public function show($id)
    {
        $competition = Competition::find($id);
        return view('competitions.show', compact('competition'));
    }

    // Afficher le formulaire de création
    #[Get('/competitions/create', name: 'competitions.create')]
    public function create()
    {
        $clubs = Club::all();
        $disciplines = Discipline::all();
        return view('competitions.create', compact('clubs', 'disciplines'));
    }

    // Sauvegarder une nouvelle compétition
    #[Post('/competitions', name: 'competitions.store')]
    public function store(Request $request)
    {
        Competition::create([
            'COM_ID' => $request->COM_ID,
            'COM_NOM' => $request->COM_NOM,
            'COM_DATE' => $request->COM_DATE,
            'CLU_ID' => $request->CLU_ID,
            'DIS_ID' => $request->DIS_ID
        ]);

        return redirect('/competitions')->with('message', 'Compétition créée avec succès !');
    }

    // Afficher le formulaire de modification
    #[Get('/competitions/{id}/edit', name: 'competitions.edit')]
    public function edit($id)
    {
        $competition = Competition::find($id);
        $clubs = Club::all();
        $disciplines = Discipline::all();
        return view('competitions.edit', compact('competition', 'clubs', 'disciplines'));
    }

    // Mettre à jour une compétition
    #[Post('/competitions/{id}/update', name: 'competitions.update')]
    public function update(Request $request, $id)
    {
        $competition = Competition::find($id);
        $competition->update([
            'COM_NOM' => $request->COM_NOM,
            'COM_DATE' => $request->COM_DATE,
            'CLU_ID' => $request->CLU_ID,
            'DIS_ID' => $request->DIS_ID
        ]);

        return redirect('/competitions')->with('message', 'Compétition modifiée avec succès !');
    }

    // Supprimer une compétition
    #[Get('/competitions/{id}/delete', name: 'competitions.destroy')]
    public function destroy($id)
    {
        Competition::destroy($id);
        return redirect('/competitions')->with('message', 'Compétition supprimée !');
    }
}
