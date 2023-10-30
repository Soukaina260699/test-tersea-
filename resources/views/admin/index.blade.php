@extends('layouts.app')

@section('content')
<div class="container">
    <table id="admin-table" class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>E-mail</th>
            </tr>
        </thead>
    </table>
</div>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        console.log('Le script est en cours d\'exécution'); // Ajoutez cette ligne
        jQuery('#admin-table').DataTable({
            "lengthChange": false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.data') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
            ],
            "initComplete": function () {
                console.log("sk" + this.api().ajax.json());
            }
        });
    });
</script>



