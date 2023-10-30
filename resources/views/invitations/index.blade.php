@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Invitations</h1>

    @if (count($invitations) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employé</th>
                    <th>E-mail de l'employé</th>
                    <th>Société</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invitations as $invitation)
                    <tr>
                        <td>{{ $invitation->id }}</td>
                        <td>{{ $invitation->name }}</td>
                        <td>{{ $invitation->email }}</td>
                        <td>{{ $invitation->societe->nom }}</td>
                        <td>{{ $invitation->is_confirmed ? 'Confirmé' : 'En attente' }}</td>
                        <td>
                            <form action="{{ route('invitations.destroy', $invitation->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr d\'annuler cette invitation ?')">Annuler</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune invitation disponible.</p>
    @endif
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