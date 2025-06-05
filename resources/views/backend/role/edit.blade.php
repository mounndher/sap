@extends('backend.layout.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Role And Permissions</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Edit Role: {{ $role->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="">Role Name</label>
                    <input type="text" class="form-control" name="role" value="{{ old('role', $role->name) }}">
                    @error('role')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <hr>
                @foreach($permissions as $groupName => $groupPermissions)
                <div class="form-group">
                    <h6 class="text-info">{{ $groupName }}</h6>
                    <div class="row">
                        @foreach($groupPermissions as $permission)
                        <div class="col-md-2">
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="permissions[]"
                                       value="{{ $permission->name }}"
                                       class="custom-switch-input"
                                       {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">{{ $permission->name }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                @endforeach

                <button type="submit" class="btn btn-primary">Update Role</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</section>

@endsection
