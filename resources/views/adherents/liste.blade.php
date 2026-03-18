<!DOCTYPE html>
<html>
<head>
    <title>Gestion des adhérents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des adhérents</h1>
        <a href="/" class="btn btn-outline-secondary">Retour à l'accueil</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle actuel</th>
                <th>Modifier le rôle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adherents as $adh)
                <tr>
                    <td>{{ $adh->ADH_ID }}</td>
                    <td>{{ $adh->ADH_NOM }}</td>
                    <td>{{ $adh->ADH_PRENOM }}</td>
                    <td>{{ $adh->ADH_EMAIL }}</td>
                    <td>
                        @if($adh->ADH_ROLE == 0) Adhérent
                        @elseif($adh->ADH_ROLE == 1) Entraîneur
                        @elseif($adh->ADH_ROLE == 2) Admin
                        @endif
                    </td>
                    <td>
                        <form action="/admin/adherents/role" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="hidden" name="ADH_ID" value="{{ $adh->ADH_ID }}">
                            <select name="ADH_ROLE" class="form-select form-select-sm" style="width: auto;">
                                <option value="0" {{ $adh->ADH_ROLE == 0 ? 'selected' : '' }}>Adhérent</option>
                                <option value="1" {{ $adh->ADH_ROLE == 1 ? 'selected' : '' }}>Entraîneur</option>
                                <option value="2" {{ $adh->ADH_ROLE == 2 ? 'selected' : '' }}>Administrateur plateforme</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
