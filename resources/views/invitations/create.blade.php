@extends('layouts.app')

@section('content')
<div class="wrapper mx-4 mt-5">
    <h1>Créer une Invitation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('invitations.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nom de l'employé :</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail de l'employé :</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="societe_id">Société :</label>
            <select name="societe_id" id="societe_id" class="form-control" required>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}">{{ $societe->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
    </form>
</div>
@endsection
