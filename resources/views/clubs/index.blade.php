<!DOCTYPE html>
<html>
<head>
    <title>Clubs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h1>Liste des Clubs</h1>
    <a href="/clubs/create" class="btn btn-primary mb-3">Ajouter Club</a>
    
    <div class="mb-3">
        <form method="GET" action="/clubs" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ $search }}">
            <button type="submit" class="btn btn-secondary">Chercher</button>
            @if($search)
                <a href="/clubs" class="btn btn-light">Réinitialiser</a>
            @endif
        </form>
    </div>
    
    <table class="table">
        <tr><th>Nom</th><th>Ville</th><th>Sport</th><th>Actions</th></tr>
        @foreach($clubs as $club)
            <tr>
                <td>{{ $club->nom }}</td>
                <td>{{ $club->ville }}</td>
                <td>{{ $club->sport }}</td>
                <td>
                    <a href="/clubs/{{ $club->id }}/edit" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="/clubs/{{ $club->id }}/delete" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
