<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search) {
            $clubs = Club::where('nom', 'like', '%'.$search.'%')
                         ->orWhere('ville', 'like', '%'.$search.'%')
                         ->orWhere('sport', 'like', '%'.$search.'%')
                         ->get();
        } else {
            $clubs = Club::all();
        }
        return view('clubs.index', compact('clubs', 'search'));
    }

    public function create()
    {
        return view('clubs.create');
    }

    public function store(Request $request)
    {
        Club::create([
            'nom' => $request->nom,
            'ville' => $request->ville,
            'sport' => $request->sport,
        ]);
        return redirect('/clubs');
    }

    public function edit($id)
    {
        $club = Club::find($id);
        return view('clubs.edit', compact('club'));
    }

    public function update(Request $request, $id)
    {
        $club = Club::find($id);
        $club->update([
            'nom' => $request->nom,
            'ville' => $request->ville,
            'sport' => $request->sport,
        ]);
        return redirect('/clubs');
    }

    public function destroy($id)
    {
        Club::find($id)->delete();
        return redirect('/clubs');
    }
}
