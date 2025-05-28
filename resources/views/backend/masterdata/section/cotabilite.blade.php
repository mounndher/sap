<form action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="account_code">Account Code</label>
        <input type="text" class="form-control" id="account_code" name="account_code" value="{{ old('account_code') }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
    </div>

    <!-- Add more inputs as needed -->

    <button type="submit" class="btn btn-primary mt-3">Save Comptabilité Data</button>
</form>
