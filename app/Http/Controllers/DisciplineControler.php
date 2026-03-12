<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function create()
    {
        return view('disciplines.create');
    }

    public function store(Request $request)
    {
        $discipline = new Discipline();
        $discipline->DIS_ID = $request->DIS_ID;
        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline ajoutée !');
    }

    public function edit($id)
    {
        $discipline = Discipline::find($id);
        return view('disciplines.edit', compact('discipline'));
    }

    public function update(Request $request, $id)
    {
        $discipline = Discipline::find($id);
        $discipline->DIS_NOM = $request->DIS_NOM;
        $discipline->save();

        return redirect('/disciplines')->with('success', 'Discipline modifiée !');
    }

    public function delete($id)
    {
        $discipline = Discipline::find($id);
        $discipline->delete();

        return redirect('/disciplines')->with('success', 'Discipline supprimée !');
    }
}