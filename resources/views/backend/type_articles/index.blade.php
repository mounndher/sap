@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Type d'Article</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">Type d'Article </h2>


        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                            <a href="{{ route('typearticles.create') }}" class="btn btn-primary mr-3">Create New</a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>value</th>
                                        <th>nom</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeArticles as $index => $typeArticle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $typeArticle->value }}</td>
                                        <td>{{ $typeArticle->name }}</td>
                                        <th> @if($typeArticle->status == '1')
                                            <div class="badge badge-success">Active</div>
                                            @else
                                            <div class="badge badge-danger">Not Active</div>
                                            @endif</th>
                                        <td>
                                            <a href="{{ route('typearticles.edit',$typeArticle->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('typearticles.destroy',$typeArticle->id) }}" class="btn btn-danger delete-item">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
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
            "sortable": false
            , "targets": [2, 3]
        }]
    });

</script>
@endpush
