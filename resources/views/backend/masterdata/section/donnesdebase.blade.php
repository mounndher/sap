<div class="card" id="settings-card">
    <form id="ajax-article-form" action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="card-header">
            <h4>Données de base</h4>
        </div>
        <div class="card-body">

            {{-- Désignation (input with datalist) --}}
            <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Désignation</label>
                <div class="col-sm-6 col-md-9">
                    <input type="text" class="form-control" id="site-title" list="designation-options" name="MAKTX">

                    <datalist id="designation-options" name="MAKTX">
                        @if (!empty($materialsData))
                        @foreach ($materialsData as $item)
                        <option value="{{ $item['MAKTX'] ?? $item['Maktg'] ?? '' }}"></option>
                        @endforeach
                        @else
                        <option value="No data available"></option>
                        @endif
                    </datalist>
                    <div id="designation-error" class="text-danger mt-2" style="display:none;">
                        Ce nom existe déjà. Veuillez entrer une désignation différente.
                    </div>
                </div>
            </div>



            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité de quantité de base</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MEINS" id="base-unit">
                        <option disabled {{ empty(old('MEINS', $article->MEINS ?? '')) ? 'selected' : '' }}>Sélectionnez une unité</option>
                        @if (!empty($unitsData))
                        @foreach ($unitsData as $unit)
                        <option value="{{ $unit['Mseh3'] }}" {{ (old('MEINS', $article->MEINS ?? '') == $unit['Mseh3']) ? 'selected' : '' }}>
                            {{ $unit['Mseh3'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            {{-- Type d'article (select) --}}
            <div class="form-group row align-items-center">
                <label for="type-article" class="form-control-label col-sm-3 text-md-right">type d'article</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MTART" id="type-article">
                        <option disabled selected>Open this select menu</option>
                        @foreach ($typearticle as $ty)
                        <option value="{{ $ty->id }}">
                            {{ $ty->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <label for="groupe-articles" class="form-control-label col-sm-3 text-md-right">Groupe d 'articles</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MATKL" id="groupe-articles">
                        <option disabled selected>Select a groupe</option>
                    </select>
                </div>
            </div>

            {{-- Gestion de lots (checkbox) --}}
            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Gestion de lots</label>
                <div class="col-sm-6 col-md-9">

                    <!-- Hidden input to send '0' if checkbox is unchecked -->
                    <input type="hidden" name="XCHPF" value="0">

                    <!-- Checkbox input to send '1' if checked -->
                    <label class="custom-switch mt-2">
                        <input type="checkbox" class="custom-switch-input" name="XCHPF" value="1">
                        <span class="custom-switch-indicator"></span>
                    </label>

                </div>
            </div>


        </div>

        <div class="card-footer bg-whitesmoke text-md-right">
            <button class="btn btn-primary" type="submit">Enregistrer</button>


        </div>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- jQuery (already included if you used it before) -->

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@push('scripts')
<script>


var baseUrl = "{{ url('groupe-articless') }}/";
    $(document).ready(function() {
        $('#type-article').on('change', function() {
            var typeArticleId = $(this).val();

            if (typeArticleId) {
                $.ajax({
                    url: baseUrl + typeArticleId
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        $('#groupe-articles').empty();
                        $('#groupe-articles').append('<option disabled selected>Select a groupe</option>');
                        $.each(data, function(key, groupe) {
                            $('#groupe-articles').append('<option value="' + groupe.id  + '">' + groupe.name + '</option>');
                        });
                    }
                    , error: function() {
                        $('#groupe-articles').empty();
                        $('#groupe-articles').append('<option disabled selected>Error loading groupes</option>');
                    }
                });
            } else {
                $('#groupe-articles').empty();
                $('#groupe-articles').append('<option disabled selected>Select a groupe</option>');
            }
        });
    });
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('site-title');
    const errorDiv = document.getElementById('designation-error');
    const options = Array.from(document.getElementById('designation-options').options)
                         .map(opt => opt.value.trim().toLowerCase())
                         .filter(v => v !== '');

    input.addEventListener('blur', function() {
        const value = input.value.trim().toLowerCase();
        if (options.includes(value)) {
            errorDiv.style.display = 'block';
            input.classList.add('is-invalid');
        } else {
            errorDiv.style.display = 'none';
            input.classList.remove('is-invalid');
        }
    });

    // Optional: Prevent form submit if duplicate
    input.form && input.form.addEventListener('submit', function(e) {
        const value = input.value.trim().toLowerCase();
        if (options.includes(value)) {
            errorDiv.style.display = 'block';
            input.classList.add('is-invalid');
            e.preventDefault();
        }
    });
});


</script>
@endpush
