<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($discipline) ? 'Modifier' : 'Créer' }} une discipline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    @if(isset($discipline))
                        <i class="bi bi-pencil-square"></i> Modifier la discipline : {{ $discipline->DIS_NOM }}
                    @else
                        <i class="bi bi-plus-circle"></i> Créer une discipline
                    @endif
                </h4>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ isset($discipline) ? '/disciplines/' . $discipline->DIS_ID : '/disciplines' }}" method="POST">
                    @if(isset($discipline))
                        @method('PUT')
                    @endif         
                @csrf
                <div class="mb-3">
                        <label for="DIS_NOM" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="DIS_NOM" name="DIS_NOM" value="{{ old('DIS_NOM', $discipline->DIS_NOM ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ isset($discipline) ? 'Modifier' : 'Créer' }}
                    </button>
                    <a href="/disciplines" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Annuler</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
