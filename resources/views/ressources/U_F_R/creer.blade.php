<!-- resources/views/ufrs/create.blade.php -->

@extends('admin.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Créer une nouvelle UFR</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('ufrs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'UFR</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Créer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
