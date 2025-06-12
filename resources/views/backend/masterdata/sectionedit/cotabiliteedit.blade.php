<div class="card" id="settings-card">
    <form method="POST" id="setting-form" action="{{ isset($articles->achat_id) ? route('articles.updateComptabilite', $articles->achat_id) : route('articles.updateComptabilite') }}">
        @csrf

        <div class="card-header">
            <h4> Comptabilité</h4>
        </div>
        <div class="card-body">

            <input type="hidden" name="article_id" value="{{ $articles->id }}">
            <input type="hidden" name="MTART" value="{{ $articles->MTART }}">

            {{-- Désignation (input with datalist) --}}


            {{-- Unité de quantité de base (dropdown) --}}
            <div class="form-group row align-items-center mt-3">
                <label for="unit" class="form-control-label col-sm-3 text-md-right">Classe Valoris</label>
                <div class="col-sm-6">
                    <select name="classe_valoris_id" class="form-control" >
                        <option value="">Choisissez une</option>
                        @foreach ($classes_valoris as $class)
                        <option value="{{ $class->id }}" {{ ($comp->classe_valoris_id ?? '') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row align-items-center mt-3">
                <label for="unit" class="form-control-label col-sm-3 text-md-right">Code prix</label>
                <div class="col-sm-6">
                    <select name="code_prix" class="form-control" required>
                        <option value="">Choisissez une</option>
                        <option value="S" {{ ($comp->code_prix ?? '') == 'S' ? 'selected' : '' }}>S || Prix Stander</option>
                        <option value="v" {{ ($comp->code_prix ?? '') == 'v' ? 'selected' : '' }}>V || Prix Moyen pondéré</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer bg-whitesmoke text-md-right">

            <button class="btn btn-primary" type="submit">Enregistrer</button>


            @if(!is_null($comp) && $comp->status == 0)
            <button class="btn btn-success validate-bttn" data-url="{{ route('comptabilite.validercomptabilite', $comp->id) }}">Valider</button>
            @endif

            @can('Comptabilité invalider')
            @if(!is_null($comp) && $comp->status == 1)
            <button class="btn btn-success invalidate-bttn" data-url="{{ route('comptabilite.invalidercomptabilite', $comp->id) }}">InValider</button>
            @endif
            @endcan
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- SCRIPT -->
<script>
 $(document).on('click', '.validate-bttn', function () {
    let url = $(this).data('url');
    let button = $(this);

    button.prop('disabled', true).text('Validation...');

    axios.post(url, {}, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(function (response) {
        toastr.success(response.data.message || 'Succès');

        // Replace button with "InValider" and swap URL
        let newUrl = url.replace('validercomptabilite', 'invalidercomptabilite');
        button.replaceWith(`
            <button class="btn btn-danger invalidate-bttn" data-url="${newUrl}">InValider</button>
        `);

        $('.nav-link.comptabilite-tab')
            .removeClass('invalid in-progress valid')
            .addClass('valid');
    })
    .catch(function (error) {
        toastr.error('Erreur lors de la validation');
        button.prop('disabled', false).text('Valider');
    });
});

$(document).on('click', '.invalidate-bttn', function () {
    let url = $(this).data('url');
    let button = $(this);

    button.prop('disabled', true).text('InValidation...');

    axios.post(url, {}, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(function (response) {
        toastr.success(response.data.message || 'Succès');

        // Replace button with "Valider" and swap URL
        let newUrl = url.replace('invalidercomptabilite', 'validercomptabilite');
        button.replaceWith(`
            <button class="btn btn-success validate-bttn" data-url="${newUrl}">Valider</button>
        `);

        $('.nav-link.comptabilite-tab')
            .removeClass('valid in-progress')
            .addClass('invalid');
    })
    .catch(function (error) {
        toastr.error('Erreur lors de la validation');
        button.prop('disabled', false).text('InValider');
    });
});



</script>
