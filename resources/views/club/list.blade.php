@extends('layouts.dashboard')

@section('title', 'Clubs')
@section('page-title', 'Clubs')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-building me-2"></i>Liste des clubs</span>
            <a href="/clubs/create" class="btn btn-primary btn-dashboard">
                <i class="bi bi-plus-circle me-1"></i> Ajouter un club
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Rue</th>
                            <th>Code Postal</th>
                            <th>Mail</th>
                            <th>Téléphone</th>
                            <th>Discipline</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clubs as $club)
                            <tr>
                                <td>{{ $club->CLU_ID }}</td>
                                <td class="fw-semibold">{{ $club->CLU_NOM }}</td>
                                <td>{{ $club->CLU_ADRESSEVILLE }}</td>
                                <td>{{ $club->CLU_ADRESSERUE }}</td>
                                <td>{{ $club->CLU_ADRESSECP }}</td>
                                <td>{{ $club->CLU_MAIL }}</td>
                                <td>{{ $club->CLU_TELFIXE }}</td>
                                <td>{{ $club->disciplines->pluck('DIS_NOM')->join(', ') ?: '-' }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="/clubs/{{ $club->CLU_ID }}/edit" class="btn btn-outline-primary btn-action">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/clubs/{{ $club->CLU_ID }}/delete" class="btn btn-outline-danger btn-action" onclick="return confirm('Voulez-vous vraiment supprimer ce club ?')">
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