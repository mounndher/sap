<!-- Include in your Blade file -->

<!-- jQuery (must be before Toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr CSS + JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- FORM -->
<div class="card" id="settings-card">
    <form id="setting-form" action="{{ isset($articles->achat_id) ? route('articles.updateAchat', $articles->achat_id) : route('articles.updateAchat') }}" method="POST">
        @csrf
        <div class="card-header">
            <h4 class="mb-0">Achat</h4>
        </div>
        <div class="card-body">
            <input type="hidden" name="article_id" value="{{ $articles->id }}">

            <!-- Unité d'achat -->
            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Unité d'achat</label>
                <div class="col-md-6">
                    <select class="form-control select2" id="unit-purchase" name="BSTME" style="width: 100%;">
                        <option value="">-- Sélectionner une unité --</option>
                        @if (!empty($unitsData))
                        @foreach ($unitsData as $unit)
                        <option value="{{ $unit['Mseh3'] }}" {{ ($achat->BSTME ?? '') == $unit['Mseh3'] ? 'selected' : '' }}>
                            {{ $unit['Mseh3'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Groupe d'Acheteur -->
            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Groupe d'Acheteur</label>
                <div class="col-md-6">
                    <select class="form-control select2" id="buyer-group" name="groupe_acheteurs_id" style="width: 100%;">
                        <option value="">-- Sélectionner un groupe --</option>
                        @if (!empty($groupeAcheteur))
                        @foreach ($groupeAcheteur as $ga)
                        <option value="{{ $ga->id }}" {{ ($achat->groupe_acheteurs_id ?? '') == $ga->id ? 'selected' : '' }}>
                            {{ $ga->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Conversion Section -->
            <div id="conversion-section" style="display: none;">
                <div class="row mb-3">
                    <div class="col-md-9 offset-md-3">
                        <h6 class="text-primary">
                            Entrez le facteur de conversion<br>
                            d'unité de qté alternative en<br>
                            unité de qté de base.
                        </h6>
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label class="form-control-label col-md-3 text-md-right"></label>
                    <div class="col-md-9">
                        <div class="d-flex align-items-center">
                            <span class="mr-2">Unité de quantité de base</span>
                            <input type="text" id="base-unit" class="form-control form-control-sm mx-1" style="width: 80px;" value="{{ $articles->MEINS ?? '' }}" readonly>
                            <input type="text" name="from" class="form-control form-control-sm mx-1" style="width: 60px;" value="{{ $achat->to ?? '1' }}">
                            <span class="mx-2" style="color: black">
                                <=>
                            </span>
                            <span class="mr-2">Unité d'achat</span>
                            <input type="text" id="unit-purchase-display" class="form-control form-control-sm mx-1" style="width: 80px;" value="{{ $articles->BSTME ?? '' }}" readonly>
                            <input type="text" name="to" class="form-control form-control-sm mx-1" style="width: 60px;" value="{{ $achat->to ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-whitesmoke text-md-right">
            @can('achat update')


            @if($achat?->status == 0)
                <button type="submit" class="btn btn-primary" id="save-achat-btn">Enregistrer</button>
            @endif

            @endcan
            @can('achat valider')
            @if (!is_null($achat) && $achat->status == 0)
            <button class="btn btn-success validate-btn" data-url="{{ route('achat.validerachat', $achat->id) }}">Valider</button>
            @endif
            @endcan

            @can('achat invalider')
            @if (!is_null($achat) && $achat->status == 1)
            <button class="btn btn-success invalidate-btn" data-url="{{ route('achat.invaliderachat', $achat->id) }}">InValider</button>
            @endif
            @endcan


        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- SCRIPT -->
<script>
    $(document).ready(function() {
        console.log('Document ready');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#setting-form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();

            $.ajax({
                url: url
                , type: 'POST'
                , data: data
                , success: function(response) {
                    console.log('AJAX success:', response);

                    toastr.options = {
                        closeButton: true
                        , progressBar: true
                        , timeOut: 5000
                        , positionClass: "toast-top-right"
                    };

                    let type = response['alert-type'] || 'success';
                    let msg = response['message'] || 'Opération réussie';

                    toastr[type](msg);
                }
                , error: function(xhr) {
                    console.log('AJAX error:', xhr);
                    toastr.error('Une erreur est survenue.');
                }
            });
        });

        function toggleConversionSection() {
            var unitPurchase = $('#unit-purchase').val();
            var baseUnit = "{{ $articles->MEINS ?? '' }}";

            if (unitPurchase === baseUnit || unitPurchase === '') {
                $('#conversion-section').hide();
            } else {
                $('#conversion-section').show();
            }

            $('#unit-purchase-display').val(unitPurchase);
        }

        $('#unit-purchase').on('change', toggleConversionSection);
        toggleConversionSection(); // initial run
    });


    $(document).on('click', '.validate-btn', function() {
        let url = $(this).data('url');
        let button = $(this);

        button.prop('disabled', true).text('Validation...');

        axios.post(url, {}, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(function(response) {
                toastr.success(response.data.message || 'Succès');
                // استبدال زر "Valider" بزر "Invalider"
                button.replaceWith(`
            <button class="btn btn-danger invalidate-btn" data-url="${button.data('url').replace('validerachat', 'invaliderachat')}">Invalider</button>
        `);

                    $('#save-achat-btn, .validatee-btn, .invalidate-btn').hide();
                // تحديث تبويب Achat
                $('.nav-link.achat-tab').removeClass('invalid valid').addClass('valid');
            })
            .catch(function(error) {
                toastr.error('Erreur lors de la validation');
                button.prop('disabled', false).text('Valider');
            });
    });

    $(document).on('click', '.invalidate-btn', function() {
        let url = $(this).data('url');
        let button = $(this);

        button.prop('disabled', true).text('InValidation...');

        axios.post(url, {}, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(function(response) {
                toastr.success(response.data.message || 'Succès');
                // استبدال زر "Invalider" بزر "Valider"
                button.replaceWith(`
            <button class="btn btn-success validate-btn" data-url="${button.data('url').replace('invaliderachat', 'validerachat')}">Valider</button>
        `);

                // تحديث تبويب Achat
                $('.nav-link.achat-tab').removeClass('invalid valid').addClass('invalid');
            })
            .catch(function(error) {
                toastr.error('Erreur lors de la validation');
                button.prop('disabled', false).text('Invalider');
            });
    });

</script>
