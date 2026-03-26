@extends('layouts.dashboard')

@section('title', 'Mes inscriptions')
@section('page-title', 'Mes inscriptions')

@section('content')
    <div class="dashboard-card">
        <div class="card-header">
            <i class="bi bi-journal-check me-2"></i>Mes demandes d'inscription
        </div>
        <div class="card-body p-0">
            @if($inscriptions->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Vous n'êtes inscrit à aucune compétition pour le moment.</p>
                    <a href="/competitions" class="btn btn-primary btn-dashboard mt-3">
                        <i class="bi bi-trophy me-1"></i> Voir les compétitions
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table dashboard-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Compétition</th>
                                <th>Date compétition</th>
                                <th>Club</th>
                                <th>Discipline</th>
                                <th>Date d'inscription</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscriptions as $ins)
                                <tr>
                                    <td class="fw-semibold">{{ $ins->competition->COM_NOM ?? '-' }}</td>
                                    <td>{{ $ins->competition->COM_DATE ?? '-' }}</td>
                                    <td>{{ $ins->competition->club->CLU_NOM ?? '-' }}</td>
                                    <td>{{ $ins->competition->discipline->DIS_NOM ?? '-' }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
