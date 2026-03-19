@extends('layouts.dashboard')

@section('title', isset($club) ? 'Modifier un club' : 'Créer un club')
@section('page-title', isset($club) ? 'Modifier le club' : 'Nouveau club')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="dashboard-card">
                <div class="card-header">
                    @if(isset($club))
                        <i class="bi bi-pencil-square me-2"></i>Modifier : {{ $club->CLU_NOM }}
                    @else
                        <i class="bi bi-plus-circle me-2"></i>Créer un club
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ isset($club) ? '/clubs/' . $club->CLU_ID . '/update' : '/clubs' }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="CLU_NOM" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="CLU_NOM" name="CLU_NOM" value="{{ old('CLU_NOM', $club->CLU_NOM ?? '') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="CLU_ADRESSERUE" class="form-label">Rue</label>
                                <input type="text" class="form-control" id="CLU_ADRESSERUE" name="CLU_ADRESSERUE" value="{{ old('CLU_ADRESSERUE', $club->CLU_ADRESSERUE ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="CLU_ADRESSECP" class="form-label">Code Postal</label>
                                <input type="text" class="form-control" id="CLU_ADRESSECP" name="CLU_ADRESSECP" value="{{ old('CLU_ADRESSECP', $club->CLU_ADRESSECP ?? '') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="CLU_ADRESSEVILLE" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="CLU_ADRESSEVILLE" name="CLU_ADRESSEVILLE" value="{{ old('CLU_ADRESSEVILLE', $club->CLU_ADRESSEVILLE ?? '') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="CLU_MAIL" class="form-label">Mail</label>
                                <input type="email" class="form-control" id="CLU_MAIL" name="CLU_MAIL" value="{{ old('CLU_MAIL', $club->CLU_MAIL ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="CLU_TELFIXE" class="form-label">Téléphone fixe</label>
                                <input type="text" class="form-control" id="CLU_TELFIXE" name="CLU_TELFIXE" value="{{ old('CLU_TELFIXE', $club->CLU_TELFIXE ?? '') }}">
                            </div>
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
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-dashboard">
                                <i class="bi bi-check-lg me-1"></i> {{ isset($club) ? 'Modifier' : 'Créer' }}
                            </button>
                            <a href="/clubs" class="btn btn-outline-secondary btn-dashboard">
                                <i class="bi bi-arrow-left me-1"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
