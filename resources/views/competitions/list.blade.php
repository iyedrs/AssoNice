@extends('layouts.dashboard')

@section('title', 'Compétitions')
@section('page-title', 'Compétitions')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-trophy me-2"></i>Liste des compétitions</span>
            {{-- Seuls entraîneur (1) et admin (2) peuvent créer --}}
            @if(session('adherent') && session('adherent')->maxRoleCache >= 1)
                <a href="/competitions/create" class="btn btn-primary btn-dashboard">
                    <i class="bi bi-plus-circle me-1"></i> Ajouter une compétition
                </a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Club local</th>
                            <th>Club invité</th>
                            <th>Discipline</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($competitions as $competition)
                            <tr>
                                <td class="fw-semibold">{{ $competition->COM_NOM }}</td>
                                <td>{{ $competition->COM_DATE }}</td>
                                <td>{{ $competition->club->CLU_NOM ?? '-' }}</td>
                                <td>{{ $competition->invitedClub->CLU_NOM ?? '-' }}</td>
                                <td>{{ $competition->discipline->DIS_NOM ?? '-' }}</td>
                                <td class="text-center text-nowrap">
                                    {{-- Adhérent (role 0) : bouton s'inscrire --}}
                                    @if(session('adherent') && session('adherent')->maxRoleCache == 0)
                                        <form action="/competitions/{{ $competition->COM_ID }}/inscrire" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-action" title="S'inscrire">
                                                <i class="bi bi-plus-circle"></i> S'inscrire
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Entraîneur (role 1) : voir inscriptions, participants validés, modifier --}}
                                    @if(session('adherent') && session('adherent')->maxRoleCache >= 1)
                                        <a href="/competitions/{{ $competition->COM_ID }}/inscriptions" class="btn btn-outline-info btn-action" title="Voir inscriptions">
                                            <i class="bi bi-person-check"></i>
                                        </a>
                                        <a href="/competitions/{{ $competition->COM_ID }}/participants" class="btn btn-outline-success btn-action" title="Participants validés">
                                            <i class="bi bi-people-fill"></i>
                                        </a>
                                        <a href="/competitions/{{ $competition->COM_ID }}/edit" class="btn btn-outline-primary btn-action" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endif

                                    {{-- Admin (role 2) : supprimer --}}
                                    @if(session('adherent') && session('adherent')->maxRoleCache >= 2)
                                        <a href="/competitions/{{ $competition->COM_ID }}/delete" class="btn btn-outline-danger btn-action" onclick="return confirm('Voulez-vous vraiment supprimer cette compétition ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection