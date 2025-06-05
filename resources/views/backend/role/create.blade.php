@extends('backend.layout.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Role And Permissions</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Role</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Role Name</label>
                    <input type="text" class="form-control" name="role">
                      @error('role')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                </div>

                <hr>
                @foreach($permissions as $grpoupName => $permission)

                <div class="form-group">
                    <h6 class=" text-info">{{ $grpoupName }}</h6>



                    <div class="row">
                        @foreach($permission as $item)
                        <div class="col-md-2">
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="permissions[]" value="{{ $item->name }}" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">{{ $item->name }}</span>
                            </label>

                        </div>
                        @endforeach
                    </div>

                </div>
                 <HR>
                @endforeach

                <button type="submit" class="btn btn-primary">Create</button>
            </form>


        </div>
    </div>
</section>


@endsection
