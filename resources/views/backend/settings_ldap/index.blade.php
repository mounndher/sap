@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Paramètres Ldap</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Modifier les paramètres du mail</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('Ldapsetting.update',1) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mailer">LDAP_CONNECTION</label>
                            <input name="LDAP_CONNECTION" type="text" class="form-control @error('LDAP_CONNECTION') is-invalid @enderror" id="mailer" value="{{ old('LDAP_CONNECTION', $settings->LDAP_CONNECTION) }}">
                            @error('LDAP_CONNECTION') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="host">LDAP_HOST</label>
                            <input name="LDAP_HOST" type="text" class="form-control @error('LDAP_HOST') is-invalid @enderror" id="host" value="{{ old('LDAP_HOST', $settings->LDAP_HOST) }}">
                            @error('LDAP_HOST') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="port">LDAP_PORT</label>
                            <input name="LDAP_PORT" type="number" class="form-control @error('LDAP_PORT') is-invalid @enderror" id="port" value="{{ old('LDAP_PORT', $settings->LDAP_PORT) }}">
                            @error('LDAP_PORT') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="LDAP_BASE_DN">LDAP_BASE_DN</label>
                            <input name="LDAP_BASE_DN" type="text" class="form-control @error('LDAP_BASE_DN') is-invalid @enderror" id="LDAP_BASE_DN" value="{{ old('LDAP_BASE_DN', $settings->LDAP_BASE_DN) }}">
                            @error('LDAP_BASE_DN') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">LDAP_PASSWORD</label>
                            <input name="LDAP_PASSWORD" type="password" class="form-control @error('LDAP_PASSWORD') is-invalid @enderror" id="password" value="{{ old('LDAP_PASSWORD', $settings->LDAP_PASSWORD) }}">
                            @error('LDAP_PASSWORD') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_address">LDAP_USERNAME</label>
                            <input name="LDAP_USERNAME" type="text" class="form-control @error('LDAP_USERNAME') is-invalid @enderror" id="from_address" value="{{ old('LDAP_USERNAME', $settings->LDAP_USERNAME) }}">
                            @error('LDAP_USERNAME') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timeout">LDAP_TIMEOUT</label>
                            <input name="LDAP_TIMEOUT" type="text" class="form-control @error('LDAP_TIMEOUT') is-invalid @enderror" id="timeout" value="{{ old('LDAP_TIMEOUT', $settings->LDAP_TIMEOUT) }}">
                            @error('LDAP_TIMEOUT') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logging">LDAP_LOGGING</label>
                            <input name="LDAP_LOGGING" type="text" class="form-control @error('LDAP_LOGGING') is-invalid @enderror" id="logging" value="{{ old('LDAP_LOGGING', $settings->LDAP_LOGGING) }}">
                            @error('LDAP_LOGGING') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timeout">LDAP_USE_TLS</label>
                            <input name="LDAP_USE_TLS" type="text" class="form-control @error('LDAP_USE_TLS') is-invalid @enderror" id="timeout" value="{{ old('LDAP_USE_TLS', $settings->LDAP_USE_TLS) }}">
                            @error('LDAP_USE_TLS') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logging">LDAP_USE_SSL</label>
                            <input name="LDAP_USE_SSL" type="text" class="form-control @error('LDAP_USE_SSL') is-invalid @enderror" id="logging" value="{{ old('LDAP_USE_SSL', $settings->LDAP_USE_SSL) }}">
                            @error('LDAP_USE_SSL') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Mettre à jour les paramètres</button>
                </div>
            </form>


        </div>
    </div>
</section>
@endsection

