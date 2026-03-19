@extends('layouts.dashboard')

@section('title', isset($competition) ? 'Modifier une compétition' : 'Créer une compétition')
@section('page-title', isset($competition) ? 'Modifier la compétition' : 'Nouvelle compétition')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="dashboard-card">
                <div class="card-header">
                    @if(isset($competition))
                        <i class="bi bi-pencil-square me-2"></i>Modifier : {{ $competition->COM_NOM }}
                    @else
                        <i class="bi bi-plus-circle me-2"></i>Créer une compétition
                    @endif
                </div>
                <div class="card-body">
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
                        <div class="row">
                            <div class="col-md-6 mb-3">
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
                            <div class="col-md-6 mb-3">
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
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-dashboard">
                                <i class="bi bi-check-lg me-1"></i> {{ isset($competition) ? 'Modifier' : 'Créer' }}
                            </button>
                            <a href="/competitions" class="btn btn-outline-secondary btn-dashboard">
                                <i class="bi bi-arrow-left me-1"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
