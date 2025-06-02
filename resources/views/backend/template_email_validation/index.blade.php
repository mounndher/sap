@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>tempalte email mesg </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>edit user sap</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('template_email_validation.update',1) }}" method="POST">
                            @csrf

                            <!-- Valeur -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">paragraph</label>
                                <div class="col-sm-12 col-md-7">

                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="paragraph" class="summernote"><p data-start="190" data-end="476" class="">
                                               {!! old('paragraph', $template->paragraph) !!}

                                                 </textarea>
                                    </div>

                                    @error('paragraph')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">codecolor</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="codecolor" class="form-control" value="{{ old('codecolor',$template->codecolor) }}">
                                    @error('codecolor')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                             <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">object</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="object" class="form-control" value="{{ old('object',$template->object) }}">
                                    @error('object')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>






                            <!-- Bouton -->
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
