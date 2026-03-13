<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($competition) ? 'Modifier' : 'Créer' }} une compétition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    @if(isset($competition))
                        <i class="bi bi-pencil-square"></i> Modifier la compétition : {{ $competition->COM_NOM }}
                    @else
                        <i class="bi bi-plus-circle"></i> Créer une compétition
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

                <form action="{{ isset($competition) ? '/competitions/' . $competition->COM_ID : '/competitions' }}" method="POST">
                    @csrf
                    @if(isset($competition))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="COM_NOM" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="COM_NOM" name="COM_NOM" value="{{ old('COM_NOM', $competition->COM_NOM ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="COM_DATE" class="form-label">Date</label>
                        <input type="date" class="form-control" id="COM_DATE" name="COM_DATE" value="{{ old('COM_DATE', $competition->COM_DATE ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="CLU_ID" class="form-label">Club</label>
                        <select class="form-select" id="CLU_ID" name="CLU_ID" required>
                            <option value="">-- Choisir --</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->CLU_ID }}" {{ old('CLU_ID', $competition->CLU_ID ?? '') == $club->CLU_ID ? 'selected' : '' }}>
                                    {{ $club->CLU_NOM }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="DIS_ID" class="form-label">Discipline</label>
                        <select class="form-select" id="DIS_ID" name="DIS_ID" required>
                            <option value="">-- Choisir --</option>
                            @foreach($disciplines as $discipline)
                                <option value="{{ $discipline->DIS_ID }}" {{ old('DIS_ID', $competition->DIS_ID ?? '') == $discipline->DIS_ID ? 'selected' : '' }}>
                                    {{ $discipline->DIS_NOM }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ isset($competition) ? 'Modifier' : 'Créer' }}
                    </button>
                    <a href="/competitions" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Annuler</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
