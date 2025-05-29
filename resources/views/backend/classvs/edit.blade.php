@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Modifier la classe d'article</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modifier Class Valorise</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('classvs.update',$allClassvs->id) }}" method="POST">
                            @csrf


                            <!-- Valeur -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Valeur</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="value" class="form-control" value="{{ old('value', $allClassvs->value) }}">
                                    @error('value')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nom</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $allClassvs->name) }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type Article -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type d'article</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="type_article_id" class="form-control select2">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach($typeArticles as $type)
                                            <option value="{{ $type->id }}" {{ old('type_article_id', $allClassvs->type_article_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_article_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Statut -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Afficher à l'accueil</label>
                                <div class="col-sm-12 col-md-7">
                                    <label class="custom-switch mt-2">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" value="1" class="custom-switch-input" {{ old('status', $allClassvs->status) ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    <a href="{{ route('classvs.index') }}" class="btn btn-secondary">Annuler</a>
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

