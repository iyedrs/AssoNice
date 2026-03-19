@extends('layouts.dashboard')

@section('title', isset($role) ? 'Modifier un rôle' : 'Créer un rôle')
@section('page-title', isset($role) ? 'Modifier le rôle' : 'Nouveau rôle')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="dashboard-card">
                <div class="card-header">
                    @if(isset($role))
                        <i class="bi bi-pencil-square me-2"></i>Modifier : {{ $role->ROL_LIBELLE }}
                    @else
                        <i class="bi bi-plus-circle me-2"></i>Créer un rôle
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ isset($role) ? '/roles/' . $role->ROL_ID : '/roles' }}" method="POST">
                        @csrf
                        @if(isset($role))
                            @method('PUT')
                        @endif

                        @if(!isset($role))
                            <div class="mb-3">
                                <label for="ROL_ID" class="form-label">ID du rôle</label>
                                <input type="number" class="form-control" id="ROL_ID" name="ROL_ID" value="{{ old('ROL_ID') }}" required>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="ROL_LIBELLE" class="form-label">Libellé</label>
                            <input type="text" class="form-control" id="ROL_LIBELLE" name="ROL_LIBELLE" value="{{ old('ROL_LIBELLE', $role->ROL_LIBELLE ?? '') }}" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-dashboard">
                                <i class="bi bi-check-lg me-1"></i> {{ isset($role) ? 'Modifier' : 'Créer' }}
                            </button>
                            <a href="/roles" class="btn btn-outline-secondary btn-dashboard">
                                <i class="bi bi-arrow-left me-1"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
