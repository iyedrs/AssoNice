<!DOCTYPE html>
<html>
<head>
    <title>Liste des clubs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-building"></i> Liste des clubs</h4>
                <a href="/clubs/create" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter un club</a>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Ville</th>
                                <th>Rue</th>
                                <th>Code Postal</th>
                                <th>Mail</th>
                                <th>Téléphone</th>
                                <th>Discipline</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clubs as $club)
                                <tr>
                                    <td>{{ $club->CLU_ID }}</td>
                                    <td class="fw-semibold">{{ $club->CLU_NOM }}</td>
                                    <td>{{ $club->CLU_ADRESSEVILLE }}</td>
                                    <td>{{ $club->CLU_ADRESSERUE }}</td>
                                    <td>{{ $club->CLU_ADRESSECP }}</td>
                                    <td>{{ $club->CLU_MAIL }}</td>
                                    <td>{{ $club->CLU_TELFIXE }}</td>
                                    <td>{{ $club->discipline->DIS_NOM ?? '-' }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="/clubs/{{ $club->CLU_ID }}/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <form action="/clubs/{{ $club->CLU_ID }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce club ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>