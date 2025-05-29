@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Class valoris</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">Class valoris</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                            <a href="{{ route('classvs.create') }}" class="btn btn-primary mr-3">Create New</a>
                        </div>
                    </div>
            <div class="card-body">
                <div class="table-responsive">
                      <table class="table table-bordered" id="table-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Value</th>
                        <th>Name</th>
                        <th>Type Article</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classvs as $index => $classv)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $classv->value }}</td>
                        <td>{{ $classv->name }}</td>
                        <td>{{ $classv->typeArticle->name ?? 'N/A' }}</td>
                        <td> @if($classv->status == '1')
                             <div class="badge badge-success">Active</div>
                                            @else
                                            <div class="badge badge-danger">Not Active</div>
                                            @endif</th></td>
                        <td>
                          <a href="{{ route('classvs.edit',$classv->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                         <a href="{{ route('classvs.destroy',$classv->id) }}" class="btn btn-danger delete-item">
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
