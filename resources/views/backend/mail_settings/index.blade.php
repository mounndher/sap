@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Paramètres Mail SMTP</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Modifier les paramètres du mail</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('mail_settings.update', 1) }}" method="POST">
                @csrf
               

                <div class="row">
                    <div class="col-md-6">
                        <label for="mail_mailer">MAIL_MAILER</label>
                        <input name="mail_mailer" type="text" class="form-control @error('mail_mailer') is-invalid @enderror" id="mail_mailer" value="{{ old('mail_mailer', $mailSettings->mail_mailer) }}">
                        @error('mail_mailer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="mail_host">MAIL_HOST</label>
                        <input name="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror" id="mail_host" value="{{ old('mail_host', $mailSettings->mail_host) }}">
                        @error('mail_host') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="mail_port">MAIL_PORT</label>
                        <input name="mail_port" type="number" class="form-control @error('mail_port') is-invalid @enderror" id="mail_port" value="{{ old('mail_port', $mailSettings->mail_port) }}">
                        @error('mail_port') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="mail_encryption">MAIL_ENCRYPTION</label>
                        <input name="mail_encryption" type="text" class="form-control @error('mail_encryption') is-invalid @enderror" id="mail_encryption" value="{{ old('mail_encryption', $mailSettings->mail_encryption) }}">
                        @error('mail_encryption') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="mail_username">MAIL_USERNAME</label>
                        <input name="mail_username" type="email" class="form-control @error('mail_username') is-invalid @enderror" id="mail_username" value="{{ old('mail_username', $mailSettings->mail_username) }}">
                        @error('mail_username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="mail_password">MAIL_PASSWORD</label>
                        <input name="mail_password" type="password" class="form-control @error('mail_password') is-invalid @enderror" id="mail_password" value="{{ old('mail_password', $mailSettings->mail_password) }}">
                        @error('mail_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="mail_from_address">MAIL_FROM_ADDRESS</label>
                        <input name="mail_from_address" type="email" class="form-control @error('mail_from_address') is-invalid @enderror" id="mail_from_address" value="{{ old('mail_from_address', $mailSettings->mail_from_address) }}">
                        @error('mail_from_address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="mail_from_name">MAIL_FROM_NAME</label>
                        <input name="mail_from_name" type="text" class="form-control @error('mail_from_name') is-invalid @enderror" id="mail_from_name" value="{{ old('mail_from_name', $mailSettings->mail_from_name) }}">
                        @error('mail_from_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Mettre à jour les paramètres</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
