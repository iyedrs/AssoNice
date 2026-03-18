<!DOCTYPE html>
<html>
<head>
    <title>Liste des disciplines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-list"></i> Liste des disciplines</h4>
                <a href="/disciplines/create" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter une discipline</a>
            </div>
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success m-3">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="">
                            <tr>
                                <th>Nom</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($disciplines as $discipline)
                                <tr>
                                    <td class="fw-semibold">{{ $discipline->DIS_NOM }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="/disciplines/{{ $discipline->DIS_ID }}/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
                                        <form action="/disciplines/{{ $discipline->DIS_ID }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette discipline ?')">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>