@extends('layouts.dashboard')

@section('title', 'Rôles')
@section('page-title', 'Rôles')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-shield-lock me-2"></i>Liste des rôles</span>
            <a href="/roles/create" class="btn btn-primary btn-dashboard">
                <i class="bi bi-plus-circle me-1"></i> Ajouter un rôle
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Libellé</th>
                            <th>Nb adhérents</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="fw-semibold">{{ $role->ROL_LIBELLE }}</td>
                                <td>{{ $role->adherents()->count() }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="/roles/{{ $role->ROL_ID }}/edit" class="btn btn-outline-primary btn-action">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="/roles/{{ $role->ROL_ID }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rôle ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-action">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
