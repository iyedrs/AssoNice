<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nice Asso Sport') - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    {{-- Overlay for mobile --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ── Sidebar ── --}}
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-trophy-fill brand-icon"></i>
            <h5>Nice Asso Sport</h5>
        </div>

        <div class="sidebar-nav">
            <div class="nav-section">Principal</div>
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Tableau de bord
            </a>

            {{-- Visiteur (non connecté) : voir compétitions publiques --}}
            @if(!session('adherent'))
                <div class="nav-section mt-3">Découvrir</div>
                <a href="/public/competitions" class="nav-link {{ request()->is('public/competitions*') ? 'active' : '' }}">
                    <i class="bi bi-trophy"></i> Compétitions
                </a>
            @endif

            {{-- Adhérent (role 0) : compétitions + mes inscriptions --}}
            @if(session('adherent') && session('adherent')->ADH_ROLE == 0)
                <div class="nav-section mt-3">Espace adhérent</div>
                <a href="/competitions" class="nav-link {{ request()->is('competitions') ? 'active' : '' }}">
                    <i class="bi bi-trophy"></i> Compétitions
                </a>
                <a href="/mes-inscriptions" class="nav-link {{ request()->is('mes-inscriptions') ? 'active' : '' }}">
                    <i class="bi bi-journal-check"></i> Mes inscriptions
                </a>
            @endif

            {{-- Entraîneur (role 1) : compétitions + gestion inscriptions --}}
            @if(session('adherent') && session('adherent')->ADH_ROLE == 1)
                <div class="nav-section mt-3">Espace entraîneur</div>
                <a href="/competitions" class="nav-link {{ request()->is('competitions*') ? 'active' : '' }}">
                    <i class="bi bi-trophy"></i> Compétitions
                </a>
            @endif

            {{-- Admin (role 2) : tout gérer --}}
            @if(session('adherent') && session('adherent')->ADH_ROLE == 2)
                <div class="nav-section mt-3">Gestion</div>
                <a href="/clubs" class="nav-link {{ request()->is('clubs*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Clubs
                </a>
                <a href="/disciplines" class="nav-link {{ request()->is('disciplines*') ? 'active' : '' }}">
                    <i class="bi bi-bookmark-star"></i> Disciplines
                </a>
                <a href="/competitions" class="nav-link {{ request()->is('competitions*') ? 'active' : '' }}">
                    <i class="bi bi-trophy"></i> Compétitions
                </a>
                <div class="nav-section mt-3">Administration</div>
                <a href="/admin/adherents" class="nav-link {{ request()->is('admin/adherents*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Adhérents
                </a>
            @endif
        </div>

        @if(session('adherent'))
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('adherent')->ADH_PRENOM, 0, 1)) }}{{ strtoupper(substr(session('adherent')->ADH_NOM, 0, 1)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ session('adherent')->ADH_PRENOM }} {{ session('adherent')->ADH_NOM }}</div>
                        <div class="user-role">
                            {{ \App\Models\Role::find(session('adherent')->ADH_ROLE)->ROL_LIBELLE ?? 'Adhérent' }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </nav>

    {{-- ── Topbar ── --}}
    <header class="topbar">
        <div class="d-flex align-items-center">
            <button class="btn-sidebar-toggle me-2" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="page-title">@yield('page-title', 'Tableau de bord')</h1>
        </div>
        <div class="topbar-actions">
            @if(session('adherent'))
                <a href="/deconnexion" class="btn btn-outline-danger btn-sm btn-dashboard">
                    <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                </a>
            @else
                <a href="/connexion" class="btn btn-outline-primary btn-sm btn-dashboard me-1">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                </a>
                <a href="/inscription" class="btn btn-primary btn-sm btn-dashboard">
                    <i class="bi bi-person-plus me-1"></i> Inscription
                </a>
            @endif
        </div>
    </header>

    {{-- ── Main Content ── --}}
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
