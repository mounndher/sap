<div class="card" id="settings-card">
                    <form id="setting-form" action="{{ route('articles.updateAchat',$articles->id) }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Données de base</h4>
                        </div>
                        <div class="card-body">


                            <div class="form-group row align-items-center">
                                <label for="base-unit" class="form-control-label col-sm-3 text-md-right">Unité d'achat    </label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" class="form-control" id="base-unit" list="unit-options" name="BSTME" value="{{ $articles->BSTME ?? '' }}">

                                    <datalist id="unit-options" name="BSTME">
                                        @if (!empty($unitsData))
                                        @foreach ($unitsData as $unit)
                                        <option value="{{ $unit['Mseh3'] }}">{{ $unit['Mseh3'] }}</option> {{-- رمز الوحدة والوصف --}}
                                        @endforeach
                                        @endif

                                    </datalist>
                                </div>
                            </div>













                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button class="btn btn-primary" id="save-btn">Save Changes</button>

                        </div>
                    </form>
                </div>
