@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('groupearticles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Créer un groupe d'article</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Créer un groupe d'article</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('groupearticles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Value Field -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Valeur du groupe</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="value" class="form-control" value="{{ old('value') }}">
                                    @error('value')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name Field -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nom du groupe</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type Article Select -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type d'article</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="type_article_id" class="form-control select2">
                                        <option value="">-- Choisir un type d'article --</option>
                                        @foreach($typeArticles as $typeArticle)
                                            <option value="{{ $typeArticle->id }}" {{ old('type_article_id') == $typeArticle->id ? 'selected' : '' }}>
                                                {{ $typeArticle->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_article_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Show in Home -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Show in Home</label>
                                <div class="col-sm-12 col-md-7">
                                    <label class="custom-switch mt-2">
                                        <input type="hidden" name="status" value="0">
                                        <input value="1" type="checkbox" name="status" class="custom-switch-input" {{ old('status') ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>

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
