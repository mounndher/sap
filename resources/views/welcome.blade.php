@if ($errors->any())
    <div style="color: red;">
        <strong>Login failed:</strong> {{ $errors->first() }}
    </div>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Input -->
    <div>
        <label for="name">name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>
    <div>
        <label for="name">name</label>
        <input id="name" type="text" name="username" value="{{ old('name') }}" required autofocus>
    </div>

    <!-- Password Input -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <!-- Remember Me -->
    <div>
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <!-- Submit -->
    <div>
        <button type="submit">Login</button>
    </div>
</form>
@error('name')
    <div style="color: red;">{{ $message }}</div>
@enderror

@error('password')
    <div style="color: red;">{{ $message }}</div>
@enderror
