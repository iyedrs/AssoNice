<!DOCTYPE html>
<html>
<head>
    <title>Créer Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h1>Ajouter un Club</h1>
    
    <form action="/clubs" method="POST" class="w-50">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sport</label>
            <input type="text" name="sport" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="/clubs" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
