@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Créer un type d'article </h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Créer un type d'article</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('typearticles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf



                            <!-- Name Field -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">value type d'Article</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="value" class="form-control">
                                    @error('value')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">type d'Article</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
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
                                        <input value="1" type="checkbox" name="status" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>



                            <!-- Submit Button -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
