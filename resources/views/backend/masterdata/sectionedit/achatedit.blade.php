<div class="card" id="settings-card">
    <form id="setting-form" action="{{ route('articles.updateAchat', $articles->id) }}" method="POST">
        @csrf
        <div class="card-header">
            <h4 class="mb-0">Données de base</h4>
        </div>
        <div class="card-body">
            <input type="hidden" name="article_id" value="{{ $articles->id }}">

            {{-- Unité d'achat --}}
            <div class="form-group row align-items-center">
                <label for="unit-purchase" class="form-control-label col-md-3 text-md-right">Unité d'achat</label>
                <div class="col-md-6">
                    <select class="form-control select2" id="unit-purchase" name="BSTME" style="width: 100%;">
                        <option value="">-- Sélectionner une unité --</option>
                        @if (!empty($unitsData))
                        @foreach ($unitsData as $unit)
                        <option value="{{ $unit['Mseh3'] }}" {{ ($articles->BSTME ?? '') == $unit['Mseh3'] ? 'selected' : '' }}>
                            {{ $unit['Mseh3'] }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            {{-- Groupe d'Acheteur --}}
            <div class="form-group row align-items-center">
                <label for="buyer-group" class="form-control-label col-md-3 text-md-right">Groupe d'Acheteur</label>
                <div class="col-md-6">
                    <select class="form-control select2" id="buyer-group" name="EKGRP" style="width: 100%;">
                        <option value="">-- Sélectionner un groupe --</option>
                        @if (!empty($groupeAcheteur))
                        @foreach ($groupeAcheteur as $ga)
                        <option value="{{ $ga->value }}" {{ ($articles->EKGRP ?? '') == $ga->value ? 'selected' : '' }}>
                            {{ $ga->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 offset-md-3">
                    <hr style="border-top: 1px solid #e4e6fc;">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-9 offset-md-3">
                    <h6 class="text-primary">Conversion d'unités</h6>
                </div>
            </div>

            {{-- Unité de quantité de base --}}
            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Unité de quantité de base</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $articles->MEINS ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="from" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Unité d'achat - display selected unit --}}
            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Unité d'achat </label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="unit-purchase-display" class="form-control" value="{{ $articles->BSTME ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="from" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer bg-whitesmoke text-md-right">
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

{{-- Script section to update the readonly input --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#unit-purchase').on('change', function() {
            var selectedUnit = $(this).val();
            $('#unit-purchase-display').val(selectedUnit);
        });

        // Initialize with default value if already selected
        var initialUnit = $('#unit-purchase').val();
        $('#unit-purchase-display').val(initialUnit);
    });
</script>
