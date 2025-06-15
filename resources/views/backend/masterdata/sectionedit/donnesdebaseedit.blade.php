<script>
    console.log("Script loaded");

</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card" id="settings-card">
    <form id="setting-form" action="{{ route('articles.updatedonneesbase',$articles->id) }}" method="POST">
        @csrf
        <div class="card-header">
            <h4>Données de base</h4>
        </div>
        <div class="card-body">

            <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Désignation</label>
                <div class="col-sm-6 col-md-9">
                    <input type="text" class="form-control" id="site-title" list="designation-options" name="MAKTX" value="{{ $articles->MAKTX }}">

                    <datalist id="designation-options" name="MAKTX">
                        @if (!empty($materialsData))
                        @foreach ($materialsData as $item)
                        <option value="{{ $item['Maktg'] }}"></option>
                        @endforeach
                        @else
                        <option value="No data available"></option>
                        @endif
                    </datalist>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité de quantité de base</label>
                <div class="col-sm-6 col-md-9">
                    <input type="text" class="form-control" id="base-unit" list="unit-options" name="MEINS" value="{{ $articles->MEINS }}">

                    <datalist id="unit-options">
                        @if (!empty($unitsData) && is_array($unitsData))
                        @foreach ($unitsData as $unit)
                        <option value="{{ $unit['Mseh3'] ?? '' }}">
                            {{-- The text here is ignored by browsers but you can keep for reference --}}
                        </option>
                        @endforeach
                        @else
                        <option value="">No units available</option>
                        @endif
                    </datalist>

                </div>
            </div>


            <div class="form-group row align-items-center">
                <label class="form-control-label col-sm-3 text-md-right">type d'article</label>
                <div class="col-sm-6 col-md-9">

                    <select class="form-control select2" name="MTART" id="mtart">
                        <option value="">Open this select menu</option>
                        @foreach ($typearticle as $ty)
                        <option value="{{ $ty->id }}" {{  $articles->MTART == $ty->id ? 'selected' : '' }}> {{ $ty->name }}</option>
                        @endforeach
                    </select>



                </div>
            </div>
            <div class="form-group row align-items-center">
    <label for="groupe-articles" class="form-control-label col-sm-3 text-md-right">Groupe d'articles</label>
    <div class="col-sm-6 col-md-9">
        <select class="form-control select2" name="MATKL" id="groupe-articles">
            <option disabled>Chargement...</option>
        </select>
    </div>
</div>





            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Gestion de lots</label>
                <div class="col-sm-6 col-md-9">

                    <!-- Hidden input to send '0' if checkbox is unchecked -->
                    <input type="hidden" name="XCHPF" value="0">

                    <!-- Checkbox input to send '1' if checked -->
                    <label class="custom-switch mt-2">
                        <input type="checkbox" class="custom-switch-input" name="XCHPF" value="1" {{ old('XCHPF', $articles->XCHPF) == 1 ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>

                </div>
            </div>





        </div>
        <div class="card-footer bg-whitesmoke text-md-right">
            @if ($articles->status == 0)
        {{-- Show Delete button when validated --}}


        {{-- Show Save button when not validated --}}
        <button class="btn btn-primary" id="save-btn">Save Changes</button>
        @else

        <script>
        console.log('Données de base validées');
        </script>
    @endif

    </form>
    @can('valider donneesdebase')
    @if ($articles->status == 0)
    <button class="btn btn-success validatee-btn" data-id="{{ $articles->id }}">Valider</button>
    @endif
    @endcan
    @can('invalider donneesdebase')
    @if ($articles->status == 1)
    <button class="btn btn-success invalidatee-btn" data-id="{{ $articles->id }}">InValider</button>
    @endif
    @endcan


</div>

</div><!-- Toastr CSS + JS -->

@push('scripts')
<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- jQuery (required for DOM access) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var articleBaseUrl = "{{ url('articles') }}/";
    console.log("Script loaded");

    // ✅ Use delegated event binding in case content is dynamic
   // ✅ Valider Donnes de Base
var articleBaseUrl = "{{ url('articles') }}/";

$(document).on('click', '.validatee-btn', function () {
    let articleId = $(this).data('id');
    let button = $(this);

    if (!articleId) {
        console.error("Article ID not found.");
        return;
    }

    button.prop('disabled', true).text('Validation...');

    axios.post(articleBaseUrl + 'validerdonnesdebase/' + articleId, {}, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(function (response) {
        toastr.success(response.data.message || 'Succès');
        button.replaceWith(`<button class="btn btn-danger invalidatee-btn" data-id="${articleId}">InValider</button>`);
        $('#save-btn, .validatee-btn, .invalidatee-btn').hide();
        $('.nav-link.donnesdebase-tab').removeClass('invalid in-progress').addClass('valid');
    })
    .catch(function (error) {
        console.error("AJAX Error:", error);
        toastr.error('Erreur lors de la validation');
        button.prop('disabled', false).text('Valider');
    });
});

$(document).on('click', '.invalidatee-btn', function () {
    let articleId = $(this).data('id');
    let button = $(this);

    if (!articleId) {
        console.error("Article ID not found.");
        return;
    }

    button.prop('disabled', true).text('InValidation...');

    axios.post(articleBaseUrl + 'invaliderdonnesdebase/' + articleId, {}, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(function (response) {
        toastr.success(response.data.message || 'Données invalidées');
        button.replaceWith(`<button class="btn btn-success validatee-btn" data-id="${articleId}">Valider</button>`);
        $('.nav-link.donnesdebase-tab').removeClass('valid in-progress').addClass('invalid');
    })
    .catch(function (error) {
        console.error("AJAX Error:", error);
        toastr.error('Erreur lors de l’invalidation');
        button.prop('disabled', false).text('InValider');
    });
});














      $(document).ready(function () {
        function loadGroupes(typeId, selectedValue = null) {
            if (!typeId) return;

            axios.post("{{ route('get.groupes.by.type') }}", {
                type_id: typeId
            }, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(response => {
                const groupes = response.data;
                const select = $('#groupe-articles');
                select.empty().append(`<option value="">Choisir un groupe</option>`);

                groupes.forEach(groupe => {
                    select.append(`<option value="${groupe.id}" ${selectedValue == groupe.id ? 'selected' : ''}>${groupe.name}</option>`);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des groupes:', error);
                toastr.error("Échec du chargement des groupes.");
            });
        }

        // Charger au démarrage
        const initialType = $('#mtart').val();
        const selectedGroupId = "{{ $articles->MATKL }}";
        if (initialType) {
            loadGroupes(initialType, selectedGroupId);
        }

        // Changement de type
        $('#mtart').on('change', function () {
            const typeId = $(this).val();
            loadGroupes(typeId);
        });
    });
</script>
@endpush
