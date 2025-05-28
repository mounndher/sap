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
                    <input type="text" class="form-control" id="site-title" list="designation-options" name="MAKTX" ">

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
                    <input type="text" class="form-control" id="base-unit" list="unit-options" name="MEINS">

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
                        <option value="ZACD" >ZACD | Articles Conditionnement</option>
                        <option value="ZAPR" >ZAPR | Articles Ext.Prestations</option>
                        <option value="ZCNS" >ZCNS | Article non géré en stock</option>
                        <option value="ZCNV" >ZCNV | Article non valorisé</option>
                        <option value="ZCST" >ZCST | Matières et fourn.consom.</option>
                        <option value="ZEMC" >ZEMC | Emballages (Cartons)</option>
                        <option value="ZFMP" >ZFMP | </option>
                        <option value="ZIMO" >ZIMO | Immobilisation</option>
                        <option value="ZMPR" >ZMPR | Matière première</option>
                        <option value="ZOUT" >ZOUT | Outilage</option>
                        <option value="ZPDR" >ZPDR | Pièces de rechange</option>
                        <option value="ZPRF" >ZPRF | Produit fini</option>
                        <option value="ZPSF" >ZPSF | Produit semi-fini</option>
                        <option value="ZSRV" >ZSRV | Prestation de services</option>
                    </select>
                </div>
            </div>

            {{-- Groupe d'articles (select) --}}
            <div class="form-group row align-items-center">
                <label for="groupe-articles" class="form-control-label col-sm-3 text-md-right">Groupe d 'articles</label>
                <div class="col-sm-6 col-md-9">
                    <select class="form-control select2" name="MATKL" id="groupe-articles">
                        <option disabled {{ empty(old('MATKL', $article->MATKL ?? '')) ? 'selected' : '' }}>Open this select menu</option>

                        <option value="ZACD-PRIM">ZACD-PRIM | Art. Cond. 1ere</option>
                        <option value="ZACD-SECD" >ZACD-SECD | Art. Cond. 2ere</option>
                        <option value="ZACD-TERT" {{ old('MATKL', $article->MATKL ?? '') == 'ZACD-TERT' ? 'selected' : '' }}>ZACD-TERT | Art. Cond. 3ere</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.cons ad</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.com</option>
                        <option value="ZCNS-ENRG" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-ENRG' ? 'selected' : '' }}>ZCNS-ENRG |Art. Nn Sto.Energies</option>
                        <option value="ZCNS-LAB" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-LAB' ? 'selected' : '' }}>ZCNS-LAB |Art. Nn Sto.cons lab</option>
                        <option value="ZCNS-PROD" {{ old('MATKL', $article->MATKL ?? '') == 'ZCNS-PROD' ? 'selected' : '' }}>ZCNS-PROD |Art. Nn Sto.cons pro</option>
                        <option value="ZCW-CON" {{ old('MATKL', $article->MATKL ?? '') == 'ZCW-CON' ? 'selected' : '' }}>ZCW-CON |Art. Nn Val.Conso</option>
                        <option value="ZCW-EXC" >ZCW-EXC |Art. Nn Val.EXC</option>
                        <option value="ZCW-PA" >ZCW-PA |Art. Nn Val.PA</option>
                        <option value="ZCST-CANT" >ZCST-CANT| Cons. Four.cantine</option>
                        <option value="ZCST-CONS" >ZCST-CONS | Cons. Four.cons ad</option>
                        <option value="ZCST-DIVE" >ZCST-DIVE |Cons. Four.Divers</option>
                        <option value="ZCST-FOUR" >ZCST-FOUR | Cons. Four.prod</option>
                        <option value="ZEMC-EMBA" >ZEMC-EMBA | Emballages</option>
                        <option value="ZFMP" >ZFMP</option>
                        <option value="ZIMO" >ZIMO | Immobilisation</option>
                        <option value="ZMPR" >ZMPR | Matière première</option>
                        <option value="ZOUT" >ZOUT | Outilage</option>
                        <option value="ZPDR" >ZPDR | Pièces de rechange</option>
                        <option value="ZPRF" >ZPRF | Produit fini</option>
                        <option value="ZPSF" >ZPSF | Produit semi-fini</option>
                        <option value="ZSRV" >ZSRV | Prestation de services</option>
                    </select>
                </div>
            </div>

             <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Groupe dacheteurs</label>
                <div class="col-sm-6 col-md-9">

                    <select class="form-control select2" name="EKGRP">
                        <option>Open this select menu</option>

                        <option value="G01">G01|MP Locale</option>
                        <option value="G02">G02|MP Import</option>
                        <option value="G03">G03|Cdtmnt Local</option>
                        <option value="G04">G04|Cdtmnt Import</option>
                        <option value="G05">G05|Labo Local</option>
                        <option value="G06">G06|Labo Import</option>
                        <option value="G07">G07|Consommable Local</option>
                        <option value="G08">G08|Consommable Import</option>
                        <option value="G09">G09|Service</option>
                        <option value="G10">G10|PDR & Outilage Lo</option>
                        <option value="G11">G11|PDR & Outilage Im</option>
                        <option value="G12">G12|Parc Roulant</option>
                        <option value="G13">G13|Investissement</option>
                        <option value="G14">G14|Sous-traitance</option>
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
