<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/disciplines')]
class DisciplineController extends Controller
{
    #[Get('/create')]
    public function create()
    {
        return view('disciplines.create');
    }

    #[Post('/')]
    public function store(Request $request)
    {
        $discipline = new Discipline();
        $discipline->DIS_ID = $request->DIS_ID;
        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline ajoutée !');
    }

    #[Get('/{id}/edit')]
    public function edit($id)
    {
        $discipline = Discipline::find($id);
        return view('disciplines.edit', compact('discipline'));
    }

    #[Post('/{id}/update')]
    public function update(Request $request, $id)
    {
        $discipline = Discipline::find($id);
        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline modifiée !');
    }

    #[Get('/{id}/delete')]
    public function delete($id)
    {
        $discipline = Discipline::find($id);
        $discipline->delete();

        return redirect('/disciplines')->with('success', 'Discipline supprimée !');
    }
}