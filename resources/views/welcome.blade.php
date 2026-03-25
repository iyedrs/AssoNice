@extends('layouts.dashboard')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
    @if(session('adherent'))
        {{-- Stat cards adaptées au rôle --}}
        <div class="row g-4 mb-4">

            {{-- Adhérent (role 0) --}}
            @if(session('adherent')->ADH_ROLE == 0)
                <div class="col-sm-6 col-xl-4">
                    <a href="/competitions" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon amber"><i class="bi bi-trophy"></i></div>
                            <div class="stat-info">
                                <p>Compétitions</p>
                                <h3>S'inscrire</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <a href="/mes-inscriptions" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon green"><i class="bi bi-journal-check"></i></div>
                            <div class="stat-info">
                                <p>Mes inscriptions</p>
                                <h3>Consulter</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- Entraîneur (role 1) --}}
            @if(session('adherent')->ADH_ROLE == 1)
                <div class="col-sm-6 col-xl-4">
                    <a href="/competitions" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon amber"><i class="bi bi-trophy"></i></div>
                            <div class="stat-info">
                                <p>Compétitions</p>
                                <h3>Gérer</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- Administrateur (role 2) --}}
            @if(session('adherent')->ADH_ROLE == 2)
                <div class="col-sm-6 col-xl-3">
                    <a href="/clubs" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon blue"><i class="bi bi-building"></i></div>
                            <div class="stat-info">
                                <p>Clubs</p>
                                <h3>Gérer</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="/disciplines" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon green"><i class="bi bi-bookmark-star"></i></div>
                            <div class="stat-info">
                                <p>Disciplines</p>
                                <h3>Gérer</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="/competitions" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon amber"><i class="bi bi-trophy"></i></div>
                            <div class="stat-info">
                                <p>Compétitions</p>
                                <h3>Gérer</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="/admin/adherents" class="text-decoration-none">
                        <div class="stat-card">
                            <div class="stat-icon purple"><i class="bi bi-people"></i></div>
                            <div class="stat-info">
                                <p>Adhérents</p>
                                <h3>Gérer</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    @else
        {{-- Not logged in --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="dashboard-card text-center">
                    <div class="card-body py-4">
                        <i class="bi bi-trophy-fill text-primary" style="font-size: 3rem;"></i>
                        <h3 class="mt-3 mb-2">Bienvenue sur Nice Asso Sport</h3>
                        <p class="text-muted mb-0">Plateforme de gestion des clubs sportifs et des compétitions.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Liste des compétitions visible par tous --}}
    <div class="dashboard-card">
        <div class="card-header">
            <i class="bi bi-trophy me-2"></i>Compétitions
        </div>
        <div class="card-body p-0">
            @if($competitions->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-calendar-x" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Aucune compétition pour le moment.</p>
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

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
