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
                                    @foreach($adh->roles as $r)
                                        @if($r->ROL_ID == 0)
                                            <span class="badge badge-role badge-adherent">{{ $r->ROL_LIBELLE }}</span>
                                        @elseif($r->ROL_ID == 1)
                                            <span class="badge badge-role badge-entraineur">{{ $r->ROL_LIBELLE }}</span>
                                        @elseif($r->ROL_ID == 2)
                                            <span class="badge badge-role badge-admin">{{ $r->ROL_LIBELLE }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form action="/admin/adherents/role" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        <input type="hidden" name="ADH_ID" value="{{ $adh->ADH_ID }}">
                                        @foreach($roles as $role)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->ROL_ID }}" id="role_{{ $adh->ADH_ID }}_{{ $role->ROL_ID }}"
                                                    {{ $adh->roles->contains('ROL_ID', $role->ROL_ID) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role_{{ $adh->ADH_ID }}_{{ $role->ROL_ID }}">{{ $role->ROL_LIBELLE }}</label>
                                            </div>
                                        @endforeach
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
