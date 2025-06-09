<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classv;
use App\Models\TypeArticle;
class ClassvController extends Controller
{
    public function __construct() {
        $this->middleware("permission:Class valoris index")->only(['index']);
        $this->middleware("permission:Class valoris create")->only(['create', 'store']);
        $this->middleware("permission:Class valoris update")->only(['edit', 'update']);
        $this->middleware("permission:Class valoris delete")->only(['destroy']);
    }

      public function index()
    {
        $classvs = Classv::with('typeArticle')->get();
        return view('backend.classvs.index', compact('classvs'));
    }

    public function create()
    {
        $typeArticles = TypeArticle::all();
        return view('backend.classvs.create', compact('typeArticles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'name' => 'required|string',

        ]);

        Classv::create($request->all());

        return redirect()->route('classvs.index')->with('success', 'Created successfully.');
    }

  public function edit($id)
{
    $typeArticles = TypeArticle::all();
    $allClassvs = Classv::with('typeArticle')->findOrFail($id);  // pour charger tous les classv avec leur type d'article

    return view('backend.classvs.edit', compact('typeArticles', 'allClassvs'));
}

    public function update(Request $request, Classv $classv)
    {
        $request->validate([
            'value' => 'required|string',
            'name' => 'required|string',
            'type_article_id' => 'required|exists:type_articles,id',
        ]);

        $classv->update($request->all());

        return redirect()->route('classvs.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Classv $classv)
    {
        $classv->delete();
        return redirect()->route('classvs.index')->with('success', 'Deleted successfully.');
    }
}
