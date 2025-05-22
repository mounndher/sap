@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Master DATA</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="#">Settings</a></div>
            <div class="breadcrumb-item">General Settings</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">All About Master DATA</h2>
        <p class="section-lead">
            You can adjust all general settings here
        </p>

        <div id="output-status"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jump To</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column" id="settings-tabs">
                            <li class="nav-item"><a href="#" class="nav-link active" data-target="#form-general">General</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-target="#form-seo">SEO</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-target="#form-email">Email</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-target="#form-system">System</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-target="#form-security">Security</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-target="#form-automation">Automation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form id="setting-form">
                    <div class="card" id="settings-card">
                        <div class="card-header">
                            <h4>General Settings</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group row align-items-center">
                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Désignation</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" name="site_title" class="form-control" id="site-title" list="designation-options">

                                    <datalist id="designation-options">
                                        @if (!empty($materialsData) && isset($materialsData['d']['results']))
                                        @foreach ($materialsData['d']['results'] as $item)
                                        <option value="{{ $item['Maktg'] }}">
                                            @endforeach
                                            @else
                                        <option value="No data available">
                                            @endif
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité de quantité de base</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" name="base_unit" class="form-control" id="base-unit" list="unit-options">

                                    <datalist id="unit-options">
                                        @if (!empty($unitData) && isset($unitData['d']['results']))
                                        @foreach ($unitData['d']['results'] as $item)
                                        <option value="{{ $item['Msehi'] }}">
                                            @endforeach
                                            @else
                                        <option value="No data available">
                                            @endif

                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité D achat </label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" name="base_unit" class="form-control" id="base-unit" list="unit-options">

                                    <datalist id="unit-options">

                                    </datalist>
                                </div>
                            </div>



                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button class="btn btn-primary" id="save-btn">Save Changes</button>
                            <button class="btn btn-secondary" type="button">Reset</button>
                        </div>
                    </div>
                </form>

                <div id="form-seo" class="settings-form d-none">
                    <form>
                        <div class="card">
                            <div class="card-header">
                                <h4>SEO Settings</h4>
                            </div>
                            <div class="card-body">
                                <!-- SEO form fields -->
                            </div>
                            <div class="card-footer text-md-right">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Repeat for other forms: form-email, form-system, form-security, form-automation -->
            </div>


        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('#settings-tabs .nav-link');
        const forms = document.querySelectorAll('.settings-form');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));

                // Hide all forms
                forms.forEach(f => f.classList.add('d-none'));

                // Activate current tab and show corresponding form
                tab.classList.add('active');
                const target = tab.getAttribute('data-target');
                document.querySelector(target).classList.remove('d-none');
            });
        });
    });

</script>
@endpush
