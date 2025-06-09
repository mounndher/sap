<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupeArticle;
use App\Models\TypeArticle;
class GroupeArticleController extends Controller
{
    //
     public function __construct() {
        $this->middleware("permission:Groupe Article index")->only(['index']);
        $this->middleware("permission:Groupe Article create")->only(['create', 'store']);
        $this->middleware("permission:Groupe Article update")->only(['update']);
        $this->middleware("permission:Groupe Article delete")->only(['destroy']);
    }

    public function index()
    {
        $groupeArticles = GroupeArticle::with('typeArticle')->get(); // eager load typeArticle
        return view('backend.groupe_articles.index', compact('groupeArticles'));
    }

    // Show form to create new groupe article
    public function create()
    {
        $typeArticles = TypeArticle::all(); // for select dropdown
        return view('backend.groupe_articles.create', compact('typeArticles'));
    }

    // Store new groupe article
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type_article_id' => 'required|exists:type_articles,id',
        ]);
        // Create new groupe article
        // Ensure the type_article_id exists in type_articles table
        $groupeArticle = new GroupeArticle();
        $groupeArticle->value = $request->value;
        $groupeArticle->name = $request->name;
        $groupeArticle->type_article_id = $request->type_article_id;
        // Save the groupe article
        // You can also use the create method if you prefer
        $groupeArticle->save();
        $alert = [
            'type' => 'success',
            'message' => 'Groupe article created successfully.',
        ];
          return redirect()->route('groupearticles.index')->with($alert);



    }

    // Show form to edit existing groupe article
    public function edit($id)
    {
        $groupeArticle = GroupeArticle::findOrFail($id);
        $typeArticles = TypeArticle::all();
        return view('backend.groupe_articles.edit', compact('groupeArticle', 'typeArticles'));
    }

    // Update groupe article
    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type_article_id' => 'required|exists:type_articles,id',
        ]);

        $groupeArticle = GroupeArticle::findOrFail($id);
         $groupeArticle->value = $request->value;
        $groupeArticle->name = $request->name;
        $groupeArticle->type_article_id = $request->type_article_id;
        // Save the groupe article
        // You can also use the create method if you prefer
        $groupeArticle->save();

        return redirect()->route('groupearticles.index')->with('success', 'Groupe article updated successfully.');
    }

    // Delete groupe article
    public function destroy($id)
    {
        $groupeArticle = GroupeArticle::findOrFail($id);
        $groupeArticle->delete();

        return redirect()->route('groupearticles.index')->with('success', 'Groupe article deleted successfully.');
    }
}
