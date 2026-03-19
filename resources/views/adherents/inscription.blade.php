@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
    <h2>Inscription</h2>
    <p class="auth-subtitle">Créez votre compte pour rejoindre la plateforme.</p>

    <form action="/inscription" method="POST">
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="ADH_NOM" class="form-control" value="{{ old('ADH_NOM') }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="ADH_PRENOM" class="form-control" value="{{ old('ADH_PRENOM') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Date de naissance</label>
            <input type="date" name="ADH_DDN" class="form-control" value="{{ old('ADH_DDN') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="ADH_ADRESSE" class="form-control" value="{{ old('ADH_ADRESSE') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="ADH_EMAIL" class="form-control" value="{{ old('ADH_EMAIL') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="ADH_HASH_PWD" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label class="form-label">Club</label>
            <select name="CLU_ID" class="form-select" required>
                <option value="">-- Sélectionner un club --</option>
                @foreach($clubs as $club)
                    <option value="{{ $club->CLU_ID }}" {{ old('CLU_ID') == $club->CLU_ID ? 'selected' : '' }}>{{ $club->CLU_NOM }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Discipline</label>
            <select name="DIS_ID" class="form-select" required>
                <option value="">-- Sélectionner une discipline --</option>
                @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->DIS_ID }}" {{ old('DIS_ID') == $discipline->DIS_ID ? 'selected' : '' }}>{{ $discipline->DIS_NOM }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-person-plus me-1"></i> S'inscrire
        </button>
    </form>

    <p class="text-center mt-3 mb-0">Déjà inscrit ? <a href="/connexion" class="auth-link">Se connecter</a></p>
@endsection
