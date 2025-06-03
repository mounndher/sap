<div class="card" id="settings-card">
  <form id="setting-form"
      action="{{ isset($articles->achat_id) ? route('articles.updateAchat', $articles->achat_id) : route('articles.updateAchat') }}"
      method="POST">
    @csrf
    <div class="card-header">
        <h4 class="mb-0">Achat</h4>
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
                <select class="form-control select2" id="buyer-group" name="groupe_acheteurs_id" style="width: 100%;">
                    <option value="">-- Sélectionner un groupe --</option>
                    @if (!empty($groupeAcheteur))
                        @foreach ($groupeAcheteur as $ga)
                            <option value="{{ $ga->id }}" {{ ($articles->groupe_acheteurs_id ?? '') == $ga->id ? 'selected' : '' }}>
                                {{ $ga->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        {{-- SECTION: Conversion d'unités --}}
        <div id="conversion-section" style="display: none;">
            <div class="row mb-3">
                <div class="col-md-9 offset-md-3">
                    <h6 class="text-primary">Conversion d'unités</h6>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Unité de quantité de base</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="base-unit" class="form-control" value="{{ $articles->MEINS ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="from" class="form-control" value="1" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <label class="form-control-label col-md-3 text-md-right">Unité d'achat</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="unit-purchase-display" class="form-control" value="{{ $articles->BSTME ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="to" class="form-control" value="" placeholder="">
                        </div>
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



{{-- Script section --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
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

        $('#unit-purchase').on('change', function () {
            toggleConversionSection();
        });

        toggleConversionSection(); // on page load
    });
     $('#setting-form').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                alert('تم التحديث بنجاح!');
                // يمكن إضافة تحديثات في الواجهة هنا حسب الحاجة
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // أخطاء التحقق من البيانات
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = [];
                    $.each(errors, function(key, messages) {
                        errorMessages.push(messages.join(', '));
                    });
                    alert('أخطاء:\n' + errorMessages.join('\n'));
                } else {
                    alert('حدث خطأ غير متوقع.');
                }
            }
        });
    });
</script>
