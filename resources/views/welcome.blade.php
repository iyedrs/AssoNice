@extends('layouts.dashboard')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
    @if(session('adherent'))
        {{-- Stat cards --}}
        <div class="row g-4 mb-4">
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
            @if(session('adherent')->ADH_ROLE == 2)
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

        {{-- Welcome card --}}
        <div class="dashboard-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon blue me-3" style="width:42px;height:42px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Bienvenue, {{ session('adherent')->ADH_PRENOM }} !</h5>
                        <small class="text-muted">Plateforme de gestion des clubs sportifs</small>
                    </div>
                </div>
                <p class="text-muted mb-0">Utilisez la barre de navigation à gauche pour accéder aux différentes sections : clubs, disciplines, compétitions et gestion des adhérents.</p>
            </div>
        </div>
    @else
        {{-- Not logged in --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="dashboard-card text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-trophy-fill text-primary" style="font-size: 3rem;"></i>
                        <h3 class="mt-3 mb-2">Bienvenue sur Nice Asso Sport</h3>
                        <p class="text-muted mb-4">Plateforme de gestion des clubs sportifs. Veuillez vous connecter pour accéder aux fonctionnalités.</p>
                        <a href="/connexion" class="btn btn-primary btn-dashboard me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                        </a>
                        <a href="/inscription" class="btn btn-outline-primary btn-dashboard">
                            <i class="bi bi-person-plus me-1"></i> Inscription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
