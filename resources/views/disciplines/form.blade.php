@extends('layouts.dashboard')

@section('title', isset($discipline) ? 'Modifier une discipline' : 'Créer une discipline')
@section('page-title', isset($discipline) ? 'Modifier la discipline' : 'Nouvelle discipline')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="dashboard-card">
                <div class="card-header">
                    @if(isset($discipline))
                        <i class="bi bi-pencil-square me-2"></i>Modifier : {{ $discipline->DIS_NOM }}
                    @else
                        <i class="bi bi-plus-circle me-2"></i>Créer une discipline
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ isset($discipline) ? '/disciplines/' . $discipline->DIS_ID : '/disciplines' }}" method="POST">
                        @csrf
                        @if(isset($discipline))
                            @method('PUT')
                        @endif

                        
                        <div class="mb-3">
                            <label for="DIS_NOM" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="DIS_NOM" name="DIS_NOM" value="{{ old('DIS_NOM', $discipline->DIS_NOM ?? '') }}" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-dashboard">
                                <i class="bi bi-check-lg me-1"></i> {{ isset($discipline) ? 'Modifier' : 'Créer' }}
                            </button>
                            <a href="/disciplines" class="btn btn-outline-secondary btn-dashboard">
                                <i class="bi bi-arrow-left me-1"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
