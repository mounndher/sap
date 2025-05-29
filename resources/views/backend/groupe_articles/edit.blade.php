@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('groupearticles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Groupe Article</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Groupe Article</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('groupearticles.update', $groupeArticle->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                         

                            <!-- Value -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Value</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="value" class="form-control" value="{{ old('value', $groupeArticle->value) }}">
                                    @error('value')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $groupeArticle->name) }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type Article Select -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type Article</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="type_article_id" class="form-control select2">
                                        <option value="">-- Select Type Article --</option>
                                        @foreach($typeArticles as $typeArticle)
                                            <option value="{{ $typeArticle->id }}" {{ old('type_article_id', $groupeArticle->type_article_id) == $typeArticle->id ? 'selected' : '' }}>
                                                {{ $typeArticle->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_article_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
