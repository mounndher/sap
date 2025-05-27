<div class="card" id="settings-card">
    <form id="setting-form" action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="card-header">
            <h4>Données de base</h4>
        </div>
        <div class="card-body">

            {{-- Désignation (input with datalist) --}}
            <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Désignation</label>
                <div class="col-sm-6 col-md-9">
                    <input type="text" class="form-control" id="site-title" list="designation-options" name="MAKTX" value="{{ old('MAKTX', $article->MAKTX ?? '') }}">

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

            {{-- Unité de quantité de base (input with datalist) --}}
            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité de quantité de base</label>
                <div class="col-sm-6 col-md-9">
                    <input type="text" class="form-control" id="base-unit" list="unit-options" name="MEINS" value="{{ old('MEINS', $article->MEINS ?? '') }}">

                    <datalist id="unit-options">
                        @if (!empty($unitsData))
                        @foreach ($unitsData as $unit)
                        <option value="{{ $unit['Mseh3'] }}">{{ $unit['Mseh3'] }}</option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
            </div>

            {{-- Type d'article (select) --}}
            <div class="form-group row align-items-center">
                <label for="type-article" class="form-control-label col-sm-3 text-md-right">type d'article</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MTART" id="type-article">
                        <option disabled {{ empty(old('MTART', $article->MTART ?? '')) ? 'selected' : '' }}>Open this select menu</option>
                        <option value="ZACD" {{ old('MTART', $article->MTART ?? '') == 'ZACD' ? 'selected' : '' }}>ZACD | Articles Conditionnement</option>
                        <option value="ZAPR" {{ old('MTART', $article->MTART ?? '') == 'ZAPR' ? 'selected' : '' }}>ZAPR | Articles Ext.Prestations</option>
                        <option value="ZCNS" {{ old('MTART', $article->MTART ?? '') == 'ZCNS' ? 'selected' : '' }}>ZCNS | Article non géré en stock</option>
                        <option value="ZCNV" {{ old('MTART', $article->MTART ?? '') == 'ZCNV' ? 'selected' : '' }}>ZCNV | Article non valorisé</option>
                        <option value="ZCST" {{ old('MTART', $article->MTART ?? '') == 'ZCST' ? 'selected' : '' }}>ZCST | Matières et fourn.consom.</option>
                        <option value="ZEMC" {{ old('MTART', $article->MTART ?? '') == 'ZEMC' ? 'selected' : '' }}>ZEMC | Emballages (Cartons)</option>
                        <option value="ZFMP" {{ old('MTART', $article->MTART ?? '') == 'ZFMP' ? 'selected' : '' }}>ZFMP</option>
                        <option value="ZIMO" {{ old('MTART', $article->MTART ?? '') == 'ZIMO' ? 'selected' : '' }}>ZIMO | Immobilisation</option>
                        <option value="ZMPR" {{ old('MTART', $article->MTART ?? '') == 'ZMPR' ? 'selected' : '' }}>ZMPR | Matière première</option>
                        <option value="ZOUT" {{ old('MTART', $article->MTART ?? '') == 'ZOUT' ? 'selected' : '' }}>ZOUT | Outilage</option>
                        <option value="ZPDR" {{ old('MTART', $article->MTART ?? '') == 'ZPDR' ? 'selected' : '' }}>ZPDR | Pièces de rechange</option>
                        <option value="ZPRF" {{ old('MTART', $article->MTART ?? '') == 'ZPRF' ? 'selected' : '' }}>ZPRF | Produit fini</option>
                        <option value="ZPSF" {{ old('MTART', $article->MTART ?? '') == 'ZPSF' ? 'selected' : '' }}>ZPSF | Produit semi-fini</option>
                        <option value="ZSRV" {{ old('MTART', $article->MTART ?? '') == 'ZSRV' ? 'selected' : '' }}>ZSRV | Prestation de services</option>
                    </select>
                </div>
            </div>

            {{-- Groupe d'articles (select) --}}
            <div class="form-group row align-items-center">
                <label for="groupe-articles" class="form-control-label col-sm-3 text-md-right">Groupe d 'articles</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MATKL" id="groupe-articles">
                        <option disabled {{ empty(old('MATKL', $article->MATKL ?? '')) ? 'selected' : '' }}>Open this select menu</option>

                        <option value="ZACD-PRIM" {{ old('MATKL', $article->MATKL ?? '') == 'ZACD-PRIM' ? 'selected' : '' }}>ZACD-PRIM | Art. Cond. 1ere</option>
                        <option value="ZACD-SECD" {{ old('MATKL', $article->MATKL ?? '') == 'ZACD-SECD' ? 'selected' : '' }}>ZACD-SECD | Art. Cond. 2ere</option>
                        <option value="ZACD-TERT" {{ old('MATKL', $article->MATKL ?? '') == 'ZACD-TERT' ? 'selected' : '' }}>ZACD-TERT | Art. Cond. 3ere</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.cons ad</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.com</option>
                        <option value="ZCNS-ENRG" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ENRG' ? 'selected' : '' }}>ZCNS-ENRG |Art. Nn Sto.Energies</option>
                        <option value="ZCNS-LAB" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-LAB' ? 'selected' : '' }}>ZCNS-LAB |Art. Nn Sto.cons lab</option>
                        <option value="ZCNS-PROD" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-PROD' ? 'selected' : '' }}>ZCNS-PROD |Art. Nn Sto.cons pro</option>
                        <option value="ZCW-CON" {{ old('MATKL', $article->MATKL ?? '') == 'ZCW-CON' ? 'selected' : '' }}>ZCW-CON |Art. Nn Val.Conso</option>
                        <option value="ZCW-EXC" {{ old('MATKL', $article->MATKL ?? '') == 'ZCW-EXC' ? 'selected' : '' }}>ZCW-EXC |Art. Nn Val.EXC</option>
                        <option value="ZCW-PA" {{ old('MATKL', $article->MATKL ?? '') == 'ZCW-PA' ? 'selected' : '' }}>ZCW-PA |Art. Nn Val.PA</option>
                        <option value="ZCST-CANT" {{ old('MATKL', $article->MATKL ?? '') == 'ZCST-CANT' ? 'selected' : '' }}>ZCST-CANT| Cons. Four.cantine</option>
                        <option value="ZCST-CONS" {{ old('MATKL', $article->MATKL ?? '') == 'ZCST-CONS' ? 'selected' : '' }}>ZCST-CONS | Cons. Four.cons ad</option>
                        <option value="ZCST-DIVE" {{ old('MATKL', $article->MATKL ?? '') == 'ZCST-DIVE' ? 'selected' : '' }}>ZCST-DIVE |Cons. Four.Divers</option>
                        <option value="ZCST-FOUR" {{ old('MATKL', $article->MATKL ?? '') == 'ZCST-FOUR' ? 'selected' : '' }}>ZCST-FOUR | Cons. Four.prod</option>
                        <option value="ZEMC-EMBA" {{ old('MATKL', $article->MATKL ?? '') == 'ZEMC-EMBA' ? 'selected' : '' }}>ZEMC-EMBA | Emballages</option>
                        <option value="ZFMP" {{ old('MATKL', $article->MATKL ?? '') == 'ZFMP' ? 'selected' : '' }}>ZFMP</option>
                        <option value="ZIMO" {{ old('MATKL', $article->MATKL ?? '') == 'ZIMO' ? 'selected' : '' }}>ZIMO | Immobilisation</option>
                        <option value="ZMPR" {{ old('MATKL', $article->MATKL ?? '') == 'ZMPR' ? 'selected' : '' }}>ZMPR | Matière première</option>
                        <option value="ZOUT" {{ old('MATKL', $article->MATKL ?? '') == 'ZOUT' ? 'selected' : '' }}>ZOUT | Outilage</option>
                        <option value="ZPDR" {{ old('MATKL', $article->MATKL ?? '') == 'ZPDR' ? 'selected' : '' }}>ZPDR | Pièces de rechange</option>
                        <option value="ZPRF" {{ old('MATKL', $article->MATKL ?? '') == 'ZPRF' ? 'selected' : '' }}>ZPRF | Produit fini</option>
                        <option value="ZPSF" {{ old('MATKL', $article->MATKL ?? '') == 'ZPSF' ? 'selected' : '' }}>ZPSF | Produit semi-fini</option>
                        <option value="ZSRV" {{ old('MATKL', $article->MATKL ?? '') == 'ZSRV' ? 'selected' : '' }}>ZSRV | Prestation de services</option>
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
                        <input type="checkbox" class="custom-switch-input" name="XCHPF" value="1" {{ old('XCHPF', $article->XCHPF ?? 0) == 1 ? 'checked' : '' }}>
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

</script>
@endpush
