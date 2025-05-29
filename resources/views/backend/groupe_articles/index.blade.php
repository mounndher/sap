@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Groupe Article</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Groupe Article</h2>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                            <a href="{{ route('groupearticles.create') }}" class="btn btn-primary mr-3">Create New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Value</th>
                                        <th>Name</th>
                                        <th>Type Article</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupeArticles as $index => $groupeArticle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $groupeArticle->value }}</td>
                                        <td>{{ $groupeArticle->name }}</td>
                                        <td>{{ $groupeArticle->typeArticle ? $groupeArticle->typeArticle->name : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('groupearticles.edit', $groupeArticle->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('groupearticles.destroy', $groupeArticle->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-item">
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

        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    $("#table-1").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [3, 4]
        }]
    });

    // Optional: confirm before delete

</script>
@endpush
