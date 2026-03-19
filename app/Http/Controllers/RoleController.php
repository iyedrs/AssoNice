<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/roles')]
class RoleController extends Controller
{
    #[Get('/', middleware: 'auth.adherent:2')]
    public function index()
    {
        $roles = Role::all();
        return view('roles.list', compact('roles'));
    }

    #[Get('/create', middleware: 'auth.adherent:2')]
    public function create()
    {
        return view('roles.form');
    }

    #[Post('/', middleware: 'auth.adherent:2')]
    public function store(Request $request)
    {
        $request->validate([
            'ROL_ID' => 'required|integer|unique:ROLE,ROL_ID',
            'ROL_LIBELLE' => 'required|string|max:50',
        ]);

        $role = new Role();
        $role->ROL_ID = $request->ROL_ID;
        $role->ROL_LIBELLE = $request->ROL_LIBELLE;
        $role->save();

        return redirect('/roles')->with('success', 'Rôle ajouté !');
    }

    #[Get('/{id}/edit', middleware: 'auth.adherent:2')]
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.form', compact('role'));
    }

    #[Put('/{id}', middleware: 'auth.adherent:2')]
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'ROL_LIBELLE' => 'required|string|max:50',
        ]);

        $role->ROL_LIBELLE = $request->ROL_LIBELLE;
        $role->save();

        return redirect('/roles')->with('success', 'Rôle modifié !');
    }

    #[Delete('/{id}', middleware: 'auth.adherent:2')]
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->adherents()->count() > 0) {
            return redirect('/roles')->with('error', 'Impossible de supprimer ce rôle car des adhérents y sont associés.');
        }

        $role->delete();

        return redirect('/roles')->with('success', 'Rôle supprimé !');
    }
}
