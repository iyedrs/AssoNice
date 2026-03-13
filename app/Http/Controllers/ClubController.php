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
    #[Get('/')]
    public function index()
    {
        $clubs = Club::all();
        return view('club.list', compact('clubs'));
    }

    #[Get('/create')]
    public function create()
    {
        $disciplines = Discipline::all();
        return view('club.form', compact('disciplines'));
    }

    #[Post('/')]
    public function store(Request $request)
    {
        $request->validate([
            'CLU_ID' => 'required|string|unique:CLUB,CLU_ID',
            'CLU_NOM' => 'required|string|max:255',
            'CLU_ADRESSEVILLE' => 'nullable|string|max:255',
            'CLU_ADRESSERUE' => 'nullable|string|max:255',
            'CLU_ADRESSECP' => 'nullable|string|max:10',
            'CLU_MAIL' => 'nullable|email|max:255',
            'CLU_TELFIXE' => 'nullable|string|max:20',
            'DIS_ID' => 'nullable|string',
        ]);

        Club::create($request->only([
            'CLU_ID', 'CLU_NOM', 'CLU_ADRESSEVILLE', 'CLU_ADRESSERUE',
            'CLU_ADRESSECP', 'CLU_MAIL', 'CLU_TELFIXE', 'DIS_ID'
        ]));

        return redirect('/clubs')->with('success', 'Club créé avec succès.');
    }

    #[Get('/{id}/edit')]
    public function edit($id)
    {
        $club = Club::findOrFail($id);
        $disciplines = Discipline::all();
        return view('club.form', compact('club', 'disciplines'));
    }

    #[Post('/{id}/update')]
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
            'DIS_ID' => 'nullable|string',
        ]);

        $club->update($request->only([
            'CLU_NOM', 'CLU_ADRESSEVILLE', 'CLU_ADRESSERUE',
            'CLU_ADRESSECP', 'CLU_MAIL', 'CLU_TELFIXE', 'DIS_ID'
        ]));

        return redirect('/clubs')->with('success', 'Club modifié avec succès.');
    }

    #[Get('/{id}/delete')]
    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();

        return redirect('/clubs')->with('success', 'Club supprimé avec succès.');
    }
}
