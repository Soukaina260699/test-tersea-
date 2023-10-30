@extends('layouts.app')

@section('content')

<form class="mt-5 mx-5 p-5 shadow rounded-2" method="POST" action="{{ route('admin.store') }}">
    @csrf

    <div class="form-group mb-4">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" class="form-control bg-white @error('name') is-invalid @enderror" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" class="form-control bg-white @error('email') is-invalid @enderror" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control bg-white @error('password') is-invalid @enderror" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Créer l'administrateur</button>
</form>

@endsection
