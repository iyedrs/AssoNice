@extends('layouts.dashboard')

@section('title', 'Compétitions publiques')
@section('page-title', 'Compétitions publiques')

@section('content')
    <div class="dashboard-card">
        <div class="card-header">
            <i class="bi bi-trophy me-2"></i>Compétitions à venir
        </div>
        <div class="card-body p-0">
            @if($competitions->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-calendar-x" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Aucune compétition à venir.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table dashboard-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Club local</th>
                                <th>Club invité</th>
                                <th>Discipline</th>
                                <th class="text-center">Détails</th>
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
                                    <td class="text-center">
                                        <a href="/public/competitions/{{ $competition->COM_ID }}" class="btn btn-outline-primary btn-action">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
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
