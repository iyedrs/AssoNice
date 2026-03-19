@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
    <h2>Connexion</h2>
    <p class="auth-subtitle">Connectez-vous pour accéder à votre espace.</p>

    <form action="/connexion" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="ADH_EMAIL" class="form-control" value="{{ old('ADH_EMAIL') }}" required placeholder="votre@email.com">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="ADH_HASH_PWD" class="form-control" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
        </button>
    </form>

    <p class="text-center mt-3 mb-0">Pas encore inscrit ? <a href="/inscription" class="auth-link">S'inscrire</a></p>
@endsection
