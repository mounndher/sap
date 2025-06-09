<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupeAcheteur;
class GroupeAcheteurcontroller extends Controller
{
    //
      public function __construct() {
        $this->middleware("permission:Groupes d Acheteurs index")->only(['index']);
        $this->middleware("permission:Groupes d Acheteurs create")->only(['create', 'store']);
        $this->middleware("permission:Groupes d Acheteurs update")->only(['update']);
        $this->middleware("permission:Groupes d Acheteurs delete")->only(['destroy']);
    }


      public function index()
    {
        $groupeAcheteurs = GroupeAcheteur::all();
        return view('backend.groupe_acheteurs.index', compact('groupeAcheteurs'));
    }

    // Show create form
    public function create()
    {
        return view('backend.groupe_acheteurs.create');
    }

    // Store new groupe acheteur
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'name'  => 'required|string|max:255',
        ]);

        $groupeAcheteur = New GroupeAcheteur();
        $groupeAcheteur->value = $request->input('value');
        $groupeAcheteur->name = $request->input('name');
        // Alternatively, you can use the create method
        //
         $groupeAcheteur->save();


        return redirect()->route('groupeacheteurs.index')->with('success', 'Groupe Acheteur created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $groupeAcheteur = GroupeAcheteur::findOrFail($id);
        return view('backend.groupe_acheteurs.edit', compact('groupeAcheteur'));
    }

    // Update groupe acheteur
    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'name'  => 'required|string|max:255',
        ]);

        $groupeAcheteur = GroupeAcheteur::findOrFail($id);
        $groupeAcheteur->update($request->only('value', 'name'));

        return redirect()->route('groupeacheteurs.index')->with('success', 'Groupe Acheteur updated successfully.');
    }

    // Delete groupe acheteur
    public function destroy($id)
    {
        $groupeAcheteur = GroupeAcheteur::findOrFail($id);
        $groupeAcheteur->delete();

        return redirect()->route('groupeacheteurs.index')->with('success', 'Groupe Acheteur deleted successfully.');
    }
}
