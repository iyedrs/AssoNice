@extends('layouts.dashboard')

@section('title', 'Inscriptions - ' . $competition->COM_NOM)
@section('page-title', 'Inscriptions')

@section('content')
    <div class="dashboard-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-trophy me-2"></i>{{ $competition->COM_NOM }}</span>
            <div>
                <a href="/competitions/{{ $competition->COM_ID }}/participants" class="btn btn-outline-success btn-dashboard me-1">
                    <i class="bi bi-people-fill me-1"></i> Participants validés
                </a>
                <a href="/competitions" class="btn btn-outline-secondary btn-dashboard">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-1"><strong>Date :</strong> {{ $competition->COM_DATE }}</p>
            <p class="mb-1"><strong>Club :</strong> {{ $competition->club->CLU_NOM ?? '-' }}</p>
            <p class="mb-0"><strong>Discipline :</strong> {{ $competition->discipline->DIS_NOM ?? '-' }}</p>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header">
            <i class="bi bi-person-check me-2"></i>Demandes d'inscription
        </div>
        <div class="card-body p-0">
            @if($inscriptions->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Aucune demande d'inscription pour cette compétition.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table dashboard-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Adhérent</th>
                                <th>Email</th>
                                <th>Date d'inscription</th>
                                <th>État</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscriptions as $ins)
                                <tr>
                                    <td class="fw-semibold">{{ $ins->adherent->ADH_NOM }} {{ $ins->adherent->ADH_PRENOM }}</td>
                                    <td>{{ $ins->adherent->ADH_EMAIL }}</td>
                                    <td>{{ $ins->INS_DATE }}</td>
                                    <td>
                                        @if($ins->INS_ETAT == 0)
                                            <span class="badge badge-role" style="background: #fef3c7; color: #92400e;">En attente</span>
                                        @elseif($ins->INS_ETAT == 1)
                                            <span class="badge badge-role" style="background: #dcfce7; color: #166534;">Acceptée</span>
                                        @elseif($ins->INS_ETAT == 2)
                                            <span class="badge badge-role" style="background: #fce7f3; color: #9d174d;">Refusée</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-nowrap">
                                        @if($ins->INS_ETAT == 0)
                                            <form action="/inscriptions/{{ $ins->INS_NUM }}/accepter" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success btn-action" title="Accepter">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                            <form action="/inscriptions/{{ $ins->INS_NUM }}/refuser" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-action" title="Refuser">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
