@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('mail_recipients.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Créer un groupe d'acheteurs</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Créer un groupe d'acheteurs</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mail_recipients.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Value Field -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nom</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name Field -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="email" name="email" class="form-control" value="{{ old('name') }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Show in Home (optional, if needed) -->
                              <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">status for Recipient</label>
                                <div class="col-sm-12 col-md-7">
                                    <label class="custom-switch mt-2">
                                         <input type="hidden" name="status" value="0">
                                        <input value="1" type="checkbox" name="status" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">status for validtion </label>
                                <div class="col-sm-12 col-md-7">
                                    <label class="custom-switch mt-2">
                                         <input type="hidden" name="validtion" value="0">
                                        <input value="1" type="checkbox" name="validtion" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            {{--

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Afficher à l'accueil</label>
                                <div class="col-sm-12 col-md-7">
                                    <label class="custom-switch mt-2">
                                        <input type="hidden" name="status" value="0">
                                        <input value="1" type="checkbox" name="status" class="custom-switch-input" {{ old('status') ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            --}}

                            <!-- Submit Button -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
