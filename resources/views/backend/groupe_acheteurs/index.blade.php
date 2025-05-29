@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Liste des Groupes d Acheteurs</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">Groupe Article</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                            <a href="{{ route('groupeacheteurs.create') }}" class="btn btn-primary mr-3">Create New</a>
                        </div>
                    </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Valeur</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupeAcheteurs as $index => $groupeAcheteur)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $groupeAcheteur->value }}</td>
                                    <td>{{ $groupeAcheteur->name }}</td>
                                    <td>
                                        <a href="{{ route('groupeacheteurs.edit', $groupeAcheteur->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('groupeacheteurs.destroy', $groupeAcheteur->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe d\'acheteurs ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $("#table-1").dataTable({
        "columnDefs": [
            { "sortable": false, "targets": [2,3] }
        ]
    });
</script>
@endpush
