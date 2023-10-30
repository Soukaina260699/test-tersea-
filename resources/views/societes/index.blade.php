@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Sociétés</h1>
        <button type="button" class="btn btn-success mt-5 mb-4" data-toggle="modal" data-target="#addSocietyModal">
            Ajouter societé
        </button>
        <table id="societes-table" class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Capitale</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($societes as $societe)
            <tr>
                <td>{{ $societe->nom }}</td>
                <td>{{ $societe->adresse }}</td>
                <td>{{ $societe->capitale }}</td>
                <td>
                    <button type="button" class="btn btn-primary edit-societe" data-toggle="modal" data-target="#editSocietyModal" data-societe-id="{{ $societe->id }}" data-societe-nom="{{ $societe->nom }}" data-societe-adresse="{{ $societe->adresse }}" data-societe-capitale="{{ $societe->capitale }}">Éditer</button>
                    <form action="{{ route('societes.destroy', $societe->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-societe">Supprimer</button>
                    </form>
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="addSocietyModal" tabindex="-1" role="dialog" aria-labelledby="addSocietyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSocietyModalLabel">Ajouter Société</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Society Form -->
                <form method="POST" action="{{ route('societes.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nom">Nom de la Société</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse de la Société</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>

                    <div class="form-group">
                        <label for="capitale">Capitale de la Société</label>
                        <input type="text" class="form-control" id="capitale" name="capitale" required>
                    </div>

                    <!-- Ajoutez un bouton "Submit" -->
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ferme</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de modification -->
<div class="modal fade" id="editSocietyModal" tabindex="-1" role="dialog" aria-labelledby="editSocietyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSocietyModalLabel">Modifier Société</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Forme de modification de la société -->
                <form method="POST" action="" class="edit-societe-form">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="societe-id" id="societe-id" value="{{ $societe->id }}">
                    
                    <div class="form-group">
                        <label for="societe-nom">Nom de la Société</label>
                        <input type="text" class="form-control" id="societe-nom" name="societe-nom" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="societe-adresse">Adresse de la Société</label>
                        <input type="text" class="form-control" id="societe-adresse" name="societe-adresse" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="societe-capitale">Capitale de la Société</label>
                        <input type="text" class="form-control" id="societe-capitale" name="societe-capitale" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr_auto">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   jQuery(document).ready(function () {
        jQuery('#societes-table').DataTable({
            "lengthChange": false,
        });
        
        jQuery('.edit-societe').click(function () {
            var societeId = jQuery(this).data("societe-id");
            var societeNom = jQuery(this).data("societe-nom");
            var societeAdresse = jQuery(this).data("societe-adresse");
            var societeCapitale = jQuery(this).data("societe-capitale");

            // Set the data for the specific modal
            jQuery("#societe-id").val(societeId);
            jQuery("#societe-nom").val(societeNom);
            jQuery("#societe-adresse").val(societeAdresse);
            jQuery("#societe-capitale").val(societeCapitale);

            // Set the form action dynamically
            var formAction = "{{ route('societes.update', ['societe' => 'SocieteId']) }}".replace('SocieteId', societeId);
            jQuery('.edit-societe-form').attr('action', formAction);
        });

        jQuery('.delete-societe').click(function () {
            const form = jQuery(this).parent('form');
            
            Swal.fire({
                title: 'Êtes-vous sûr de supprimer cette société ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

