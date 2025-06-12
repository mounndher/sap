@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Paramètres</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Modifier les paramètres</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('setting.update', $settings->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="title">Titre</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $settings->title) }}">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="keywords">Mots-clés</label>
                        <input name="keywords" type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywords" value="{{ old('keywords', $settings->keywords) }}">
                        @error('keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $settings->description) }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="logo">Logo</label>
                        <input name="logo" type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo">
                        @if ($settings->logo)
                        <div class="mt-2">
                            <img src="{{ asset($settings->logo) }}" alt="Logo" width="80">
                        </div>
                        @endif
                        @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="favicon">Favicon</label>
                        <input name="favicon" type="file" class="form-control-file @error('favicon') is-invalid @enderror" id="favicon">
                        @if ($settings->favicon)
                        <div class="mt-2"><img src="{{ asset($settings->favicon) }}" alt="Favicon" width="80"></div>
                        @endif
                        @error('favicon') <small class="text-danger">{{ $message }}</small> @enderror
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
