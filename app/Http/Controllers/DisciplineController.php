<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/disciplines')]
class DisciplineController extends Controller
{
    #[Get('/', middleware: 'auth.adherent:0')]
    public function index()
    {
        $disciplines = Discipline::all();
        return view('disciplines.list', compact('disciplines'));
    }

    #[Get('/create', middleware: 'auth.adherent:1')]
    public function create()
    {
        return view('disciplines.form');
    }

    #[Post('/', middleware: 'auth.adherent:1')]
    public function store(Request $request)
    {
        $request->validate([
            'DIS_ID' => 'required|string|max:50|unique:DISCIPLINE,DIS_ID',
            'DIS_NOM' => 'required|string|max:100',
        ]);

        $discipline = new Discipline();
        $discipline->DIS_ID = $request->DIS_ID;
        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline ajoutée !');
    }

    #[Get('/{id}/edit', middleware: 'auth.adherent:1')]
    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('disciplines.form', compact('discipline'));
    }

    #[Put('/{id}', middleware: 'auth.adherent:1')]
    public function update(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);

        $request->validate([
            'DIS_NOM' => 'required|string|max:100',
        ]);

        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline modifiée !');
    }

    #[Delete('/{id}', middleware: 'auth.adherent:2')]
    public function destroy($id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->delete();

        return redirect('/disciplines')->with('success', 'Discipline supprimée !');
    }
}