@extends('layouts.dashboard')

@section('title', 'Disciplines')
@section('page-title', 'Disciplines')

@section('content')
    <div class="dashboard-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-bookmark-star me-2"></i>Liste des disciplines</span>
            @if(session('adherent') && session('adherent')->maxRoleCache >= 2)
                <a href="/disciplines/create" class="btn btn-primary btn-dashboard">
                    <i class="bi bi-plus-circle me-1"></i> Ajouter une discipline
                </a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
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
                                    @if(session('adherent') && session('adherent')->maxRoleCache >= 2)
                                        <a href="/disciplines/{{ $discipline->DIS_ID }}/edit" class="btn btn-outline-primary btn-action">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/disciplines/{{ $discipline->DIS_ID }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette discipline ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-action">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection