<div class="card" id="settings-card">
    <form method="POST" id="setting-form" action="{{ route('articles.Comptabilite',$articles->id) }}">
        @csrf

        <div class="card-header">
            <h4>Données de base</h4>
        </div>
        <div class="card-body">

            {{-- Désignation (input with datalist) --}}


            {{-- Unité de quantité de base (dropdown) --}}
            <div class="form-group row align-items-center mt-3">
                <label for="unit" class="form-control-label col-sm-3 text-md-right">Classe Valoris</label>
                <div class="col-sm-6">
                    <select name="BKLAS" class="form-control " required>
                        <option value="" disabled {{ empty($articles->BKLAS) ? 'selected' : '' }}>Choisissez une</option>
                        <option value="M008" {{ ($articles->BKLAS ?? '') == 'M008' ? 'selected' : '' }}>M008 || Produit Semi Finis</option>
                        <option value="M001" {{ ($articles->BKLAS ?? '') == 'M001' ? 'selected' : '' }}>M001 || MP Substances actives</option>
                        <option value="M002" {{ ($articles->BKLAS ?? '') == 'M002' ? 'selected' : '' }}>M002 || MP Excipients</option>
                        <option value="M013" {{ ($articles->BKLAS ?? '') == 'M013' ? 'selected' : '' }}>M013 || Auther Matiéres premières</option>
                    </select>
                </div>
            </div>

            <div class="form-group row align-items-center mt-3">
                <label for="unit" class="form-control-label col-sm-3 text-md-right">Code prix</label>
                <div class="col-sm-6">
                    <select name="VPRSV_1" class="form-control" required>
                        <option value="" disabled {{ empty($articles->VPRSV_1) ? 'selected' : '' }}>Choisissez une</option>
                        <option value="S" {{ ($articles->VPRSV_1 ?? '') == 'S' ? 'selected' : '' }}>S || Prix Stander</option>
                        <option value="v" {{ ($articles->VPRSV_1 ?? '') == 'v' ? 'selected' : '' }}>V || Prix Moyen pondéré</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer bg-whitesmoke text-md-right">
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </div>
    </form>
</div>

