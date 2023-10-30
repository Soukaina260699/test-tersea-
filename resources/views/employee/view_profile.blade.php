@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Votre Profil</h1>
        <table class="table">
            <tr>
                <th>Nom</th>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $employee->address }}</td>
            </tr>
            <tr>
                <th>Date de Naissance</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $employee->phone }}</td>
            </tr>
            <tr>
                <th>Date de Naissance</th>
                <td>{{ $employee->birth_date }}</td>
            </tr>
            <tr>
                <th>Socité</th>
                <td>{{ $societe->nom }}</td>
            </tr>
        </table>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   jQuery(document).ready(function () {
        jQuery('.table').DataTable({
            "lengthChange": false,
        });
    });
</script>