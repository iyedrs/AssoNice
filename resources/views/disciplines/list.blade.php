@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des disciplines</h1>
    <a href="{{ route('disciplines.create') }}" class="btn btn-primary mb-3">Ajouter une discipline</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disciplines as $discipline)
            <tr>
                <td>{{ $discipline->id }}</td>
                <td>{{ $discipline->name }}</td>
                <td>{{ $discipline->description }}</td>
                <td>
                    <a href="{{ route('disciplines.show', $discipline->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('disciplines.edit', $discipline->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('disciplines.destroy', $discipline->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette discipline ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $disciplines->links() }}
</div>
@endsection