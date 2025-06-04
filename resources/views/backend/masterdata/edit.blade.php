@extends('backend.layout.master')

@section('content')
@php
function statusClass($status) {
return match($status) {
0 => 'invalid',
1 => 'valid',
2 => 'in-progress',
default => '',
};
}

$generalStatus = statusClass($articles->status ?? null);
$achatStatus = statusClass($achat->status ?? null);
$comptabiliteStatus = statusClass($comp->status ?? null);

//dd($article, $achat, $comp, $generalStatus, $achatStatus, $comptabiliteStatus);
@endphp

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
        <p class="section-lead">...</p>

        <div id="output-status"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>View</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column" id="settings-tabs">
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ session('active_tab', 'general') == 'general' ? 'active' : '' }} {{ $generalStatus }}" data-target="#form-general">
                                    Données de base
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link achat-tab {{ session('active_tab') == 'achat' ? 'active' : '' }} {{ $achatStatus }}" data-target="#form-achat">
                                    Achat
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link {{ session('active_tab') == 'comptabilite' ? 'active' : '' }} {{ $comptabiliteStatus }}" data-target="#form-comptabilite">
                                    Comptabilité
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div id="form-general" class="settings-form {{ session('active_tab', 'general') == 'general' ? '' : 'd-none' }}">
                    @include('backend.masterdata.sectionedit.donnesdebaseedit')
                </div>

                <div id="form-achat" class="settings-form {{ session('active_tab') == 'achat' ? '' : 'd-none' }}">
                    @include('backend.masterdata.sectionedit.achatedit')
                </div>

                <div id="form-comptabilite" class="settings-form {{ session('active_tab') == 'comptabilite' ? '' : 'd-none' }}">
                    @include('backend.masterdata.sectionedit.cotabiliteedit')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .nav-pills .nav-link.valid {
        color: #fff;
        background-color: #28a745;
        /* Green */
    }

    .nav-pills .nav-link.invalid {
        color: #fff;
        background-color: #dc3545;
        /* Red */
    }

    .nav-pills .nav-link.in-progress {
        color: #fff;
        background-color: #fd7e14;
        /* Orange */
    }

    .nav-pills .nav-link.valid.active {
        background-color: #28a745;
        box-shadow: 0 2px 6px #28a745;
    }

    .nav-pills .nav-link.invalid.active {
        background-color: #dc3545;
        box-shadow: 0 2px 6px #dc3545;
    }

    .nav-pills .nav-link.in-progress.active {
        background-color: #fd7e14;
        box-shadow: 0 2px 6px #fd7e14;
    }

</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('#settings-tabs .nav-link');
        const forms = document.querySelectorAll('.settings-form');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const target = tab.getAttribute('data-target');

                if (target !== "#form-general") {
                    const requiredField = document.querySelector('#form-general input[name="MAKTX"]');
                    if (!requiredField || requiredField.value.trim() === '') {
                        alert("Veuillez remplir le champ Données de base avant de continuer.");
                        return;
                    }
                }

                tabs.forEach(t => t.classList.remove('active'));
                forms.forEach(f => f.classList.add('d-none'));

                tab.classList.add('active');
                document.querySelector(target).classList.remove('d-none');
            });
        });
    });

</script>
@endpush
