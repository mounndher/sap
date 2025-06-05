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
            <form action="{{ route('role-users.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">

                    <input type="hidden" class="form-control" name="name" value="{{ $user->name }}">

                </div>
                <div class="form-group">

                    <input type="hidden" class="form-control" name="username" value="{{ $user->username }}">

                </div>


                <div class="form-group">
                    <label for="">all Role </label>

                    <select name="role" class="form-control select2">
                        <option value="">--Select--</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $role->name == $user->getRoleNames()->first() ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach

                    </select>
                    @error('role')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary">Create</button>
            </form>


        </div>
    </div>
</section>


@endsection
