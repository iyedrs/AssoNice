<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Nice Asso Sport</h1>
        <div>
            @if(session('adherent'))
                <span class="me-3">Bonjour, {{ session('adherent')->ADH_PRENOM }} {{ session('adherent')->ADH_NOM }}</span>
                <a href="/deconnexion" class="btn btn-outline-danger">Déconnexion</a>
            @else
                <a href="/connexion" class="btn btn-outline-primary me-2">Connexion</a>
                <a href="/inscription" class="btn btn-primary">Inscription</a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>Bienvenue sur la plateforme de gestion des clubs</p>

    @if(session('adherent'))
        <a href="/clubs" class="btn btn-primary">Voir les Clubs</a>
        <a href="/disciplines" class="btn btn-primary">Voir les Disciplines</a>
        <a href="/competitions" class="btn btn-primary">Voir les Compétitions</a>
        @if(session('adherent')->ADH_ROLE == 2)
            <a href="/admin/adherents" class="btn btn-warning">Gérer les utilisateurs</a>
        @endif
    @else
        <div class="alert alert-info">Veuillez vous connecter pour accéder aux fonctionnalités.</div>
    @endif
</body>
</html>
