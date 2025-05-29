<div class="card" id="settings-card">
    <form id="setting-form" action="{{ route('typearticles.store') }}" method="POST">
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

            <button class="btn btn-success" type="submit">Valider</button>
        </div>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#setting-form').on('submit', function(e) {
            console.log('submit triggered');
            const fields = ['MAKTX', 'MTART', 'MATKL'];
            let isValid = true;

            fields.forEach(function(name) {
                const val = $(this).find(`[name="${name}"]`).val();
                console.log(`Checking ${name}:`, val);
                if (!val || val.trim() === '') {
                    isValid = false;
                }
            }, this);

            if (!isValid) {
                console.log('Invalid form, preventing submit');
                e.preventDefault();
                alert("Veuillez remplir tous les champs Données de base.");
            }
        });
    });

    $(document).ready(function() {
        $('#setting-form').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submit (no reload)

            const form = this;

            $.ajax({
                url: $(form).attr('action')
                , method: $(form).attr('method')
                , data: $(form).serialize()
                , success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);

                        // Update articles list with new HTML from server
                        //$('#articles-list').html(response.html);

                        // Reset form fields
                        form.reset();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
                , error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors from Laravel
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        for (let key in errors) {
                            errorMessages += errors[key].join(', ') + '\n';
                        }
                        alert(errorMessages);
                    } else {
                        alert('An unexpected error occurred.');
                    }
                }
            });
        });
    });


    $(document).ready(function() {
        $('#type-article').on('change', function() {
            var typeArticleId = $(this).val();

            if (typeArticleId) {
                $.ajax({
                    url: '/groupe-articles/' + typeArticleId
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        $('#groupe-articles').empty();
                        $('#groupe-articles').append('<option disabled selected>Select a groupe</option>');
                        $.each(data, function(key, groupe) {
                            $('#groupe-articles').append('<option value="' + groupe.value + '">' + groupe.name + '</option>');
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

</script>
@endpush
