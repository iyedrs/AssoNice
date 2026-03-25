@extends('layouts.dashboard')

@section('title', 'Participants validés - ' . $competition->COM_NOM)
@section('page-title', 'Participants validés')

@section('content')
    <div class="dashboard-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-trophy me-2"></i>{{ $competition->COM_NOM }}</span>
            <a href="/competitions" class="btn btn-outline-secondary btn-dashboard">
                <i class="bi bi-arrow-left me-1"></i> Retour
            </a>
        </div>
        <div class="card-body">
            <p class="mb-1"><strong>Date :</strong> {{ $competition->COM_DATE }}</p>
            <p class="mb-1"><strong>Club :</strong> {{ $competition->club->CLU_NOM ?? '-' }}</p>
            <p class="mb-0"><strong>Discipline :</strong> {{ $competition->discipline->DIS_NOM ?? '-' }}</p>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header">
            <i class="bi bi-people-fill me-2"></i>Participants validés ({{ $participants->count() }})
        </div>
        <div class="card-body p-0">
            @if($participants->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-person-x" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Aucun participant validé pour cette compétition.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table dashboard-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Date d'inscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $p)
                                <tr>
                                    <td class="fw-semibold">{{ $p->adherent->ADH_NOM }}</td>
                                    <td>{{ $p->adherent->ADH_PRENOM }}</td>
                                    <td>{{ $p->adherent->ADH_EMAIL }}</td>
                                    <td>{{ $p->INS_DATE }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
