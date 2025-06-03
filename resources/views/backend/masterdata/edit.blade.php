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
            ...
        </p>

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
                                <a href="#" class="nav-link active  @if($articles->status == '1') valid @elseif($articles->status == '0') invalid @elseif($article->status == 'in_progress') in-progress @endif" data-target="#form-general">
                                    Données de base
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link @if($achat->status == '1') valid @elseif($achat->status == '0') invalid @elseif($achat->status == 'in_progress') in-progress @endif" data-target="#form-achat">
                                    Achat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link @if($comp->status == '1') valid @elseif($comp->status == '0') invalid @elseif($articles->status == 'in_progress') in-progress @endif" data-target="#form-comptabilite">
                                    Comptabilité
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Données de base form (shown by default) -->
                <div id="form-general" class="settings-form">
                    @include('backend.masterdata.sectionedit.donnesdebaseedit')
                </div>

                <!-- Achat form (hidden by default) -->
                <div id="form-achat" class="settings-form d-none">
                    @include('backend.masterdata.sectionedit.achatedit')

                </div>


                <!-- Comptabilité form (hidden by default) -->
                <div id="form-comptabilite" class="settings-form d-none">
                     @include('backend.masterdata.sectionedit.cotabiliteedit')
                </div>

                <!-- Remove the old SEO form as it's not needed anymore -->
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


