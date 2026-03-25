@extends('layouts.dashboard')

@section('title', $competition->COM_NOM)
@section('page-title', 'Détail de la compétition')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-trophy me-2"></i>{{ $competition->COM_NOM }}</span>
                    <a href="/public/competitions" class="btn btn-outline-secondary btn-dashboard">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="bi bi-calendar-event me-1"></i> Date :</strong></p>
                            <p class="text-muted">{{ $competition->COM_DATE }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="bi bi-bookmark-star me-1"></i> Discipline :</strong></p>
                            <p class="text-muted">{{ $competition->discipline->DIS_NOM ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="bi bi-building me-1"></i> Club local :</strong></p>
                            <p class="text-muted">{{ $competition->club->CLU_NOM ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="bi bi-building me-1"></i> Club invité :</strong></p>
                            <p class="text-muted">{{ $competition->invitedClub->CLU_NOM ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong><i class="bi bi-people me-1"></i> Inscrits :</strong></p>
                            <p class="text-muted">{{ $competition->inscription->count() }} participant(s)</p>
                        </div>
                    </div>

                    @if(session('adherent') && session('adherent')->ADH_ROLE == 0)
                        <hr>
                        <div class="text-center">
                            <form action="/competitions/{{ $competition->COM_ID }}/inscrire" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-dashboard">
                                    <i class="bi bi-plus-circle me-1"></i> S'inscrire à cette compétition
                                </button>
                            </form>
                        </div>
                    @elseif(!session('adherent'))
                        <hr>
                        <div class="text-center">
                            <p class="text-muted mb-3">Connectez-vous pour vous inscrire à cette compétition.</p>
                            <a href="/connexion" class="btn btn-primary btn-dashboard">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
