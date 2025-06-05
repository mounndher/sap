@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Role Users</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Role Users List</h2>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                              <a href="{{ route('roles.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>role</th>
                                        <th>created</th>
                                        <th>updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $user->getRoleNames()->isNotEmpty() ? $user->getRoleNames()->first() : 'No Role' }}
                                            </span>


                                        </td>

                                        <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                                        <th>
                                            @if ($user->getRoleNames()->first()!= 'Super Admin')
                                             <a href="{{ route('role-users.edit', $user->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('role-users.destroy',$user->id) }}" class="btn btn-sm btn-danger delete-item" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>


                                            @endif


                                        </th>



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
            "targets": [5,6]
        }]
    });
</script>
@endpush
