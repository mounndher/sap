@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Role and Permission') }}</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{ __('Manage Roles') }}</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{ __('Roles List') }}</h4>
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
                                        <th>{{ __('Role Name') }}</th>
                                        <th>{{ __('Permissions') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }}</span>
                                            @endforeach

                                            @if ($role->name === 'Super Admin')
                                            <span class="badge bg-danger text-light">All Permission</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $role->name!= 'Super Admin')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('roles.destroy',$role->id) }}" class="btn btn-sm btn-danger delete-item" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>


                                            @endif
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
    $(document).ready(function() {
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false
                , "targets": [2, 3]
            }]
        });
    });

</script>
@endpush
