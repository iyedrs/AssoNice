<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nice Asso Sport') - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
            --topbar-height: 60px;
            --body-bg: #f1f5f9;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--body-bg);
            overflow-x: hidden;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: #cbd5e1;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            background: #0f172a;
            border-bottom: 1px solid #334155;
        }

        .sidebar-brand h5 {
            margin: 0;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .sidebar-brand .brand-icon {
            font-size: 1.4rem;
            color: var(--sidebar-active);
            margin-right: 10px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
        }

        .sidebar-nav .nav-section {
            padding: 8px 20px 6px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            font-weight: 600;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-nav .nav-link:hover {
            color: #e2e8f0;
            background: var(--sidebar-hover);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background: var(--sidebar-hover);
            border-left-color: var(--sidebar-active);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #334155;
        }

        .sidebar-footer .user-info {
            display: flex;
            align-items: center;
        }

        .sidebar-footer .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--sidebar-active);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .sidebar-footer .user-name {
            color: #e2e8f0;
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .sidebar-footer .user-role {
            color: #64748b;
            font-size: 0.75rem;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1030;
        }

        .topbar .page-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .topbar .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.3rem;
            color: #475569;
            padding: 4px 8px;
            cursor: pointer;
        }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 24px;
            min-height: calc(100vh - var(--topbar-height));
        }

        /* ── Dashboard cards ── */
        .dashboard-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: 1px solid #e2e8f0;
        }

        .dashboard-card .card-header {
            background: transparent;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .dashboard-card .card-body {
            padding: 20px;
        }

        /* ── Table styling ── */
        .dashboard-table {
            margin-bottom: 0;
        }

        .dashboard-table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #475569;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
        }

        .dashboard-table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .dashboard-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* ── Stat cards ── */
        .stat-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: 1px solid #e2e8f0;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .stat-card .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-card .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-card .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .stat-card .stat-icon.purple { background: #ede9fe; color: #7c3aed; }

        .stat-card .stat-info h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-card .stat-info p {
            margin: 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        /* ── Buttons ── */
        .btn-dashboard {
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 6px 14px;
        }

        .btn-action {
            padding: 4px 10px;
            font-size: 0.8rem;
            border-radius: 5px;
        }

        /* ── Alerts ── */
        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        /* ── Forms ── */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--sidebar-active);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* ── Badge ── */
        .badge-role {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-adherent { background: #dbeafe; color: #1e40af; }
        .badge-entraineur { background: #fef3c7; color: #92400e; }
        .badge-admin { background: #fce7f3; color: #9d174d; }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .topbar {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .btn-sidebar-toggle {
                display: inline-block;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1035;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
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

            @if(session('adherent'))
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

                @if(session('adherent')->ADH_ROLE == 2)
                    <div class="nav-section mt-3">Administration</div>
                    <a href="/admin/adherents" class="nav-link {{ request()->is('admin/adherents*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Adhérents
                    </a>
                @endif
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
