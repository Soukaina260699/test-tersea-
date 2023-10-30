@extends('layouts.app')

@section('content')
    <div class="wrapper px-5 mt5">
        <h1>Compléter votre Profil</h1>
        <form method="POST" action="{{ route('employee.complete_profile') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Date de Naissance</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Compléter le Profil</button>
        </form>
    </div>
@endsection
