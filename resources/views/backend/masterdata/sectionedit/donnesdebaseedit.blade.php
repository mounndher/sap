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
                        <option value="ZACD" {{ old('MTART', $articles->MTART) == 'ZACD' ? 'selected' : '' }}>ZACD | Articles Conditionnement</option>
                        <option value="ZAPR" {{ old('MTART', $articles->MTART) == 'ZAPR' ? 'selected' : '' }}>ZAPR | Articles Ext.Prestations</option>
                        <option value="ZCNS" {{ old('MTART', $articles->MTART) == 'ZCNS' ? 'selected' : '' }}>ZCNS | Article non géré en stock</option>
                        <option value="ZCNV" {{ old('MTART', $articles->MTART) == 'ZCNV' ? 'selected' : '' }}>ZCNV | Article non valorisé</option>
                        <option value="ZCST" {{ old('MTART', $articles->MTART) == 'ZCST' ? 'selected' : '' }}>ZCST | Matières et fourn.consom.</option>
                        <option value="ZEMC" {{ old('MTART', $articles->MTART) == 'ZEMC' ? 'selected' : '' }}>ZEMC | Emballages (Cartons)</option>
                        <option value="ZFMP" {{ old('MTART', $articles->MTART) == 'ZFMP' ? 'selected' : '' }}>ZFMP</option>
                        <option value="ZIMO" {{ old('MTART', $articles->MTART) == 'ZIMO' ? 'selected' : '' }}>ZIMO | Immobilisation</option>
                        <option value="ZMPR" {{ old('MTART', $articles->MTART) == 'ZMPR' ? 'selected' : '' }}>ZMPR | Matière première</option>
                        <option value="ZOUT" {{ old('MTART', $articles->MTART) == 'ZOUT' ? 'selected' : '' }}>ZOUT | Outilage</option>
                        <option value="ZPDR" {{ old('MTART', $articles->MTART) == 'ZPDR' ? 'selected' : '' }}>ZPDR | Pièces de rechange</option>
                        <option value="ZPRF" {{ old('MTART', $articles->MTART) == 'ZPRF' ? 'selected' : '' }}>ZPRF | Produit fini</option>
                        <option value="ZPSF" {{ old('MTART', $articles->MTART) == 'ZPSF' ? 'selected' : '' }}>ZPSF | Produit semi-fini</option>
                        <option value="ZSRV" {{ old('MTART', $articles->MTART) == 'ZSRV' ? 'selected' : '' }}>ZSRV | Prestation de services</option>
                    </select>



                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Groupe d 'articles</label>
                <div class="col-sm-6 col-md-9">


                    <select class="form-control select2" name="MATKL" id="matkl">
                        <option value="">Open this select menu</option>

                        <option value="ZACD-PRIM" {{ old('MATKL', $articles->MATKL) == 'ZACD-PRIM' ? 'selected' : '' }}>ZACD-PRIM | Art. Cond. 1ere</option>
                        <option value="ZACD-SECD" {{ old('MATKL', $articles->MATKL) == 'ZACD-SECD' ? 'selected' : '' }}>ZACD-SECD | Art. Cond. 2ere</option>
                        <option value="ZACD-TERT" {{ old('MATKL', $articles->MATKL) == 'ZACD-TERT' ? 'selected' : '' }}>ZACD-TERT | Art. Cond. 3ere</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $articles->MATKL) == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.cons ad</option>
                        <option value="ZCNS-ADM" {{ old('MATKL', $articles->MATKL) == 'ZCNS-ADM' ? 'selected' : '' }}>ZCNS-ADM | Art. Nn Sto.com</option>
                        <option value="ZCNS-ENRG" {{ old('MATKL', $articles->MATKL) == 'ZCNS-ENRG' ? 'selected' : '' }}>ZCNS-ENRG |Art. Nn Sto.Energies</option>
                        <option value="ZCNS-LAB" {{ old('MATKL', $articles->MATKL) == 'ZCNS-LAB' ? 'selected' : '' }}>ZCNS-LAB |Art. Nn Sto.cons lab</option>
                        <option value="ZCNS-PROD" {{ old('MATKL', $articles->MATKL) == 'ZCNS-PROD' ? 'selected' : '' }}>ZCNS-PROD |Art. Nn Sto.cons pro</option>
                        <option value="ZCW-CON" {{ old('MATKL', $articles->MATKL) == 'ZCW-CON' ? 'selected' : '' }}>ZCW-CON |Art. Nn Val.Conso</option>
                        <option value="ZCW-EXC" {{ old('MATKL', $articles->MATKL) == 'ZCW-EXC' ? 'selected' : '' }}>ZCW-EXC |Art. Nn Val.EXC</option>
                        <option value="ZCW-PA" {{ old('MATKL', $articles->MATKL) == 'ZCW-PA' ? 'selected' : '' }}>ZCW-PA |Art. Nn Val.PA</option>
                        <option value="ZCST-CANT" {{ old('MATKL', $articles->MATKL) == 'ZCST-CANT' ? 'selected' : '' }}>ZCST-CANT| Cons. Four.cantine</option>
                        <option value="ZCST-CONS" {{ old('MATKL', $articles->MATKL) == 'ZCST-CONS' ? 'selected' : '' }}>ZCST-CONS | Cons. Four.cons ad</option>
                        <option value="ZCST-DIVE" {{ old('MATKL', $articles->MATKL) == 'ZCST-DIVE' ? 'selected' : '' }}>ZCST-DIVE |Cons. Four.Divers</option>
                        <option value="ZCST-FOUR" {{ old('MATKL', $articles->MATKL) == 'ZCST-FOUR' ? 'selected' : '' }}>ZCST-FOUR |Cons. Four.fourmit</option>
                        <option value="ZCST-LAB" {{ old('MATKL', $articles->MATKL) == 'ZCST-LAB' ? 'selected' : '' }}>ZCST-LAB |Cons. Four.cons labo</option>
                        <option value="ZCST-PROD" {{ old('MATKL', $articles->MATKL) == 'ZCST-PROD' ? 'selected' : '' }}>ZCST-PROD|Cons. Four.cons prod</option>
                        <option value="ZEMC-CAR" {{ old('MATKL', $articles->MATKL) == 'ZEMC-CAR' ? 'selected' : '' }}>ZEMC-CAR|Emballage.Cartons</option>
                        <option value="ZIMO-GEN" {{ old('MATKL', $articles->MATKL) == 'ZIMO-GEN' ? 'selected' : '' }}>ZIMO-GEN |Immob. General</option>
                        <option value="ZIMO-IT" {{ old('MATKL', $articles->MATKL) == 'ZIMO-IT' ? 'selected' : '' }}>ZIMO-IT |Immob. IT</option>
                        <option value="ZIMO-LAB" {{ old('MATKL', $articles->MATKL) == 'ZIMO-LAB' ? 'selected' : '' }}>ZIMO-LAB |Immob. Labo</option>
                        <option value="ZIMO-MAIN" {{ old('MATKL', $articles->MATKL) == 'ZIMO-MAIN' ? 'selected' : '' }}>ZIMO-MAIN |Immob. Maint</option>
                        <option value="ZIMO-PARC" {{ old('MATKL', $articles->MATKL) == 'ZIMO-PARC' ? 'selected' : '' }}>ZIMO-PARC |Immob. Parc</option>
                        <option value="ZIMO-PROD" {{ old('MATKL', $articles->MATKL) == 'ZIMO-PROD' ? 'selected' : '' }}>ZIMO-PROD |Immob. Prod</option>
                        <option value="ZIMO-STO" {{ old('MATKL', $articles->MATKL) == 'ZIMO-STO' ? 'selected' : '' }}>ZIMO-STO| Immob. Stock</option>
                        <option value="ZIMO-UTIL" {{ old('MATKL', $articles->MATKL) == 'ZIMO-UTIL' ? 'selected' : '' }}>ZIMO-UTIL Immob. Utilités</option>
                        <option value="ZMPR-AUT" {{ old('MATKL', $articles->MATKL) == 'ZMPR-AUT' ? 'selected' : '' }}>ZMPR-AUT| MP. Autres</option>
                        <option value="ZMPR-EXC" {{ old('MATKL', $articles->MATKL) == 'ZMPR-EXC' ? 'selected' : '' }}>ZMPR-EXC| MP. Excipients</option>
                        <option value="ZMPR-PA" {{ old('MATKL', $articles->MATKL) == 'ZMPR-PA' ? 'selected' : '' }}>ZMPR-PA| MP. Substances active</option>
                        <option value="ZOUT-CANT" {{ old('MATKL', $articles->MATKL) == 'ZOUT-CANT' ? 'selected' : '' }}>ZOUT-CANT |Outillage Cantine</option>
                        <option value="ZOUT-IT" {{ old('MATKL', $articles->MATKL) == 'ZOUT-IT' ? 'selected' : '' }}>ZOUT-IT |Outillage IT</option>
                        <option value="ZOUT-LABO" {{ old('MATKL', $articles->MATKL) == 'ZOUT-LABO' ? 'selected' : '' }}>ZOUT-LABO|Outillage Labo</option>
                        <option value="ZOUT-MAIN" {{ old('MATKL', $articles->MATKL) == 'ZOUT-MAIN' ? 'selected' : '' }}>ZOUT-MAIN| Outillage Maint.</option>
                        <option value="ZOUT-PROD" {{ old('MATKL', $articles->MATKL) == 'ZOUT-PROD' ? 'selected' : '' }}>ZOUT-PROD |Outillage Prod</option>
                        <option value="ZOUT-STO" {{ old('MATKL', $articles->MATKL) == 'ZOUT-STO' ? 'selected' : '' }}>ZOUT-STO |Outillage Stock</option>
                        <option value="ZPDR-ADM" {{ old('MATKL', $articles->MATKL) == 'ZPDR-ADM' ? 'selected' : '' }}>ZPDR-ADM |PDR Admin</option>
                        <option value="ZPDR-DIV" {{ old('MATKL', $articles->MATKL) == 'ZPDR-DIV' ? 'selected' : '' }}>ZPDR-DIV |PDR Divers</option>
                        <option value="ZPDR-IT" {{ old('MATKL', $articles->MATKL) == 'ZPDR-IT' ? 'selected' : '' }}>ZPDR-IT |PDR IT</option>
                        <option value="ZPDR-LABO" {{ old('MATKL', $articles->MATKL) == 'ZPDR-LABO' ? 'selected' : '' }}>ZPDR-LABO |PDR Labo</option>
                        <option value="ZPDR-MAN" {{ old('MATKL', $articles->MATKL) == 'ZPDR-MAN' ? 'selected' : '' }}>PDR Manutention</option>
                        <option value="ZPDR-PARC" {{ old('MATKL', $articles->MATKL) == 'ZPDR-PARC' ? 'selected' : '' }}>PDR Parc</option>
                        <option value="ZPDR-PROD" {{ old('MATKL', $articles->MATKL) == 'ZPDR-PROD' ? 'selected' : '' }}>ZPDR-PROD | PDR Prod</option>
                        <option value="ZPDR-UTIL" {{ old('MATKL', $articles->MATKL) == 'ZPDR-UTIL' ? 'selected' : '' }}>ZPDR-UTIL |PDR Util</option>
                    </select>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Groupe dacheteurs</label>
                <div class="col-sm-6 col-md-9">

                    <select class="form-control select2" name="EKGRP">
                        <option>Open this select menu</option>

                        <option value="G01" {{ old('EKGRP', $articles->EKGRP) == 'G01' ? 'selected' : '' }}>G01|MP Locale</option>
                        <option value="G02" {{ old('EKGRP', $articles->EKGRP) == 'G02' ? 'selected' : '' }}>G02|MP Import</option>
                        <option value="G03" {{ old('EKGRP', $articles->EKGRP) == 'G03' ? 'selected' : '' }}>G03|Cdtmnt Local</option>
                        <option value="G04" {{ old('EKGRP', $articles->EKGRP) == 'G04' ? 'selected' : '' }}>G04|Cdtmnt Import</option>
                        <option value="G05" {{ old('EKGRP', $articles->EKGRP) == 'G05' ? 'selected' : '' }}>G05|Labo Local</option>
                        <option value="G06" {{ old('EKGRP', $articles->EKGRP) == 'G06' ? 'selected' : '' }}>G06|Labo Import</option>
                        <option value="G07" {{ old('EKGRP', $articles->EKGRP) == 'G07' ? 'selected' : '' }}>G07|Consommable Local</option>
                        <option value="G08" {{ old('EKGRP', $articles->EKGRP) == 'G08' ? 'selected' : '' }}>G08|Consommable Import</option>
                        <option value="G09" {{ old('EKGRP', $articles->EKGRP) == 'G09' ? 'selected' : '' }}>G09|Service</option>
                        <option value="G10" {{ old('EKGRP', $articles->EKGRP) == 'G10' ? 'selected' : '' }}>G10|PDR & Outilage Lo</option>
                        <option value="G11" {{ old('EKGRP', $articles->EKGRP) == 'G11' ? 'selected' : '' }}>G11|PDR & Outilage Im</option>
                        <option value="G12" {{ old('EKGRP', $articles->EKGRP) == 'G12' ? 'selected' : '' }}>G12|Parc Roulant</option>
                        <option value="G13" {{ old('EKGRP', $articles->EKGRP) == 'G13' ? 'selected' : '' }}>G13|Investissement</option>
                        <option value="G14" {{ old('EKGRP', $articles->EKGRP) == 'G14' ? 'selected' : '' }}>G14|Sous-traitance</option>
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
            <button class="btn btn-primary" id="save-btn">Save Changes</button>
            <button class="btn btn-secondary" type="button">Reset</button>
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
