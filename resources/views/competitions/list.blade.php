@extends('layouts.dashboard')

@section('title', 'Compétitions')
@section('page-title', 'Compétitions')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-trophy me-2"></i>Liste des compétitions</span>
            <a href="/competitions/create" class="btn btn-primary btn-dashboard">
                <i class="bi bi-plus-circle me-1"></i> Ajouter une compétition
            </a>
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
                                    @if(session('adherent') && session('adherent')->ADH_ROLE >= 1)
                                        <a href="/competitions/{{ $competition->COM_ID }}/inscriptions" class="btn btn-outline-info btn-action" title="Voir inscriptions">
                                            <i class="bi bi-person-check"></i>
                                        </a>
                                    @endif

                                    @if(session('adherent') && session('adherent')->ADH_ROLE == 0)
                                        <form action="/competitions/{{ $competition->COM_ID }}/inscrire" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-action" title="S'inscrire">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="/competitions/{{ $competition->COM_ID }}/edit" class="btn btn-outline-primary btn-action">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="/competitions/{{ $competition->COM_ID }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette compétition ?')">
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