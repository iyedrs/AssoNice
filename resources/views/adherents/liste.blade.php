@extends('layouts.dashboard')

@section('title', 'Gestion des adhérents')
@section('page-title', 'Gestion des adhérents')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-people me-2"></i>Liste des adhérents</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle actuel</th>
                            <th>Modifier le rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adherents as $adh)
                            <tr>
                                <td class="fw-semibold">{{ $adh->ADH_NOM }}</td>
                                <td>{{ $adh->ADH_PRENOM }}</td>
                                <td>{{ $adh->ADH_EMAIL }}</td>
                                <td>
                                    @if($adh->ADH_ROLE == 0)
                                        <span class="badge badge-role badge-adherent">{{ $adh->role->ROL_LIBELLE ?? 'Adhérent' }}</span>
                                    @elseif($adh->ADH_ROLE == 1)
                                        <span class="badge badge-role badge-entraineur">{{ $adh->role->ROL_LIBELLE ?? 'Entraîneur' }}</span>
                                    @elseif($adh->ADH_ROLE == 2)
                                        <span class="badge badge-role badge-admin">{{ $adh->role->ROL_LIBELLE ?? 'Admin' }}</span>
                                    @else
                                        <span class="badge badge-role badge-adherent">{{ $adh->role->ROL_LIBELLE ?? 'Inconnu' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="/admin/adherents/role" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        <input type="hidden" name="ADH_ID" value="{{ $adh->ADH_ID }}">
                                        <select name="ADH_ROLE" class="form-select form-select-sm" style="width: auto;">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->ROL_ID }}" {{ $adh->ADH_ROLE == $role->ROL_ID ? 'selected' : '' }}>{{ $role->ROL_LIBELLE }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary btn-action">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="/admin/adherents/{{ $adh->ADH_ID }}/delete"
                                       class="btn btn-sm btn-outline-danger btn-action"
                                       onclick="return confirm('Voulez-vous vraiment supprimer cet adhérent ?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
