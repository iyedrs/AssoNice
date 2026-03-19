<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nice Asso Sport')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
        }

        .auth-sidebar {
            width: 45%;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .auth-sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(59,130,246,0.15) 0%, transparent 50%);
        }

        .auth-sidebar .brand {
            position: relative;
            text-align: center;
        }

        .auth-sidebar .brand-icon {
            font-size: 3rem;
            color: #3b82f6;
            margin-bottom: 16px;
        }

        .auth-sidebar .brand h2 {
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 12px;
        }

        .auth-sidebar .brand p {
            color: #94a3b8;
            font-size: 0.95rem;
            max-width: 300px;
        }

        .auth-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #f1f5f9;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 40px;
        }

        .auth-card h2 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .auth-card .auth-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 28px;
        }

        .auth-card .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
        }

        .auth-card .form-control,
        .auth-card .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 10px 14px;
            font-size: 0.9rem;
        }

        .auth-card .form-control:focus,
        .auth-card .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }

        .auth-card .btn-primary {
            background: #3b82f6;
            border-color: #3b82f6;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
        }

        .auth-card .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
        }

        .auth-card .auth-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-card .auth-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .auth-sidebar {
                display: none;
            }
            .auth-main {
                padding: 24px 16px;
            }
            .auth-card {
                padding: 28px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-trophy-fill"></i></div>
            <h2>Nice Asso Sport</h2>
            <p>Plateforme de gestion des clubs sportifs, disciplines et compétitions.</p>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-card">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
