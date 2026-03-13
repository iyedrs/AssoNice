<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($club) ? 'Modifier' : 'Créer' }} un club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    @if(isset($club))
                        <i class="bi bi-pencil-square"></i> Modifier le club : {{ $club->CLU_NOM }}
                    @else
                        <i class="bi bi-plus-circle"></i> Créer un club
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

                <form action="{{ isset($club) ? '/clubs/' . $club->CLU_ID : '/clubs' }}" method="POST">
                    @csrf
                    @if(isset($club))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="CLU_NOM" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="CLU_NOM" name="CLU_NOM" value="{{ old('CLU_NOM', $club->CLU_NOM ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="CLU_ADRESSERUE" class="form-label">Rue</label>
                        <input type="text" class="form-control" id="CLU_ADRESSERUE" name="CLU_ADRESSERUE" value="{{ old('CLU_ADRESSERUE', $club->CLU_ADRESSERUE ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="CLU_ADRESSECP" class="form-label">Code Postal</label>
                        <input type="text" class="form-control" id="CLU_ADRESSECP" name="CLU_ADRESSECP" value="{{ old('CLU_ADRESSECP', $club->CLU_ADRESSECP ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="CLU_ADRESSEVILLE" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="CLU_ADRESSEVILLE" name="CLU_ADRESSEVILLE" value="{{ old('CLU_ADRESSEVILLE', $club->CLU_ADRESSEVILLE ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="CLU_MAIL" class="form-label">Mail</label>
                        <input type="email" class="form-control" id="CLU_MAIL" name="CLU_MAIL" value="{{ old('CLU_MAIL', $club->CLU_MAIL ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="CLU_TELFIXE" class="form-label">Téléphone fixe</label>
                        <input type="text" class="form-control" id="CLU_TELFIXE" name="CLU_TELFIXE" value="{{ old('CLU_TELFIXE', $club->CLU_TELFIXE ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discipline(s)</label>
                        <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                            @foreach($disciplines as $discipline)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disciplines[]" value="{{ $discipline->DIS_ID }}" id="dis_{{ $discipline->DIS_ID }}"
                                        @if(isset($club) && $club->disciplines->contains('DIS_ID', $discipline->DIS_ID)) checked @endif
                                        @if(is_array(old('disciplines')) && in_array($discipline->DIS_ID, old('disciplines'))) checked @endif
                                    >
                                    <label class="form-check-label" for="dis_{{ $discipline->DIS_ID }}">{{ $discipline->DIS_NOM }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> {{ isset($club) ? 'Modifier' : 'Créer' }}
                    </button>
                    <a href="/clubs" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Annuler</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
