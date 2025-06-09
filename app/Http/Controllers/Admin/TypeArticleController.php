<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\TypeArticle;

class TypeArticleController extends Controller
{
    //"Type d'Article index","Type d'Article create","Type d'Article create","Type d'Article delete"
      public function __construct() {
        $this->middleware("permission:Type d'Article index")->only(['index']);
        $this->middleware("permission:Type d'Article create")->only(['create', 'store']);
        $this->middleware("permission:Type d'Article update")->only(['update']);
        $this->middleware("permission:Type d'Article delete")->only(['destroy']);
    }
    public function index()
    {
        $typeArticles = TypeArticle::all();
        return view('backend.type_articles.index', compact('typeArticles'));
    }
    public function create()
    {
        return view('backend.type_articles.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'value' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);
        $typeArticle = new TypeArticle();
        $typeArticle->value = $request->value;
        $typeArticle->name = $request->name;
        $typeArticle->status = $request->status; // Default to active if not provided
        $typeArticle->save();
        $alert = [
            'message' => 'typeArticle ajouter avec succès.',
            'alert-type' => 'success',
        ];

        return redirect()->route('typearticles.index')->with($alert);
    }
    public function edit($id)
    {
        $typeArticles = TypeArticle::findOrFail($id);
        return view('backend.type_articles.edit', compact('typeArticles'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'name' => 'required|string|max:255',

        ]);
        $typeArticle = TypeArticle::findOrFail($id);
        $typeArticle->value = $request->input('value');
        $typeArticle->name = $request->input('name');
        $typeArticle->status = $request->status;
        $typeArticle->save();
        return redirect()->route('typearticles.index')->with([
                'message' => 'typeArticle ajouter avec succès.',
                'alert-type' => 'info',
            ]);
    }


    public function destroy(TypeArticle $article)
    {
        try {
            $article->delete();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to delete this article.']);
        }
    }
}
