<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Achat;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = Article::all();
        return view('backend.masterdata.index', compact('articles'));
    }
    public function create(Request $request)
    {
        // Fetch SAP data
        $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
        $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

        $materialsResponse = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($maktUrl);
        $materialsData = $materialsResponse->successful() ? $materialsResponse->json()['d']['results'] ?? [] : null;

        $unitsResponse = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($t006aUrl);
        $unitsData = $unitsResponse->successful() ? $unitsResponse->json()['d']['results'] ?? [] : null;

        $articleId = $request->query('article_id');
        $step = $request->query('step', 'general'); // default to general tab

        return view('backend.masterdata.create', [
            'materialsData' => $materialsData,
            'unitsData' => $unitsData,
            'error' => (!$materialsData || !$unitsData) ? 'One or more datasets failed to load' : null,
            'article_id' => $articleId,
            'step' => $step,
        ]);
    }
    public function storeDonnesdebase(Request $request)
    {
        $request->validate([
            'MAKTX' => 'required|string|max:40',
            'MTART' => 'required|string|max:4',
            'MATKL' => 'required|string|max:9',
            'MEINS' => 'required',
            'XCHPF' => 'required',
            //'EKGRP' => 'required',
        ]);

        $exists = Article::where('MAKTX', $request->MAKTX)->first();

        if ($exists) {
            return redirect()->back()->with([
                'message' => 'Désolé, le Designation est déjà enregistré.',
                'alert-type' => 'error',
            ])->withInput();
        }

        $article = new Article();
        $article->MTART = $request->MTART;
        $article->MATKL = $request->MATKL;
        $article->MEINS = $request->MEINS;
        $article->XCHPF = $request->XCHPF;
        $article->MAKTX = $request->MAKTX;
      //  $article->EKGRP = $request->EKGRP;
        $article->save();

        // Redirect to create with article_id and step=achat to show Achat tab
       return redirect()->route('articles.create')->with('article_id', $article->id);
    }

    public function storeAchat(Request $request)
    {
        //DD($request->all());
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'BSTME' => 'required|string|max:3',
        ]);

        Achat::create([
            'article_id' => $request->article_id,
            'BSTME' => $request->BSTME,
        ]);

        return redirect()->route('articles.create', [
            'article_id' => $request->article_id,
            'step' => 'achat',
        ])->with('message', 'Achat enregistré avec succès.');
    }





    public function edit($id)
    {
        $articles = Article::findOrFail($id);
        $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

        // Second URL - T006ASet (Units)
        $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

        // Fetch materials data
        $materialsResponse = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($maktUrl);
        $materialsData = $materialsResponse->successful()
            ? $materialsResponse->json()['d']['results'] ?? []
            : null;

        // Fetch units data
        $unitsResponse = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($t006aUrl);
        $unitsData = $unitsResponse->successful()
            ? $unitsResponse->json()['d']['results'] ?? []
            : null;

        // Send both datasets to the view
        return view('backend.masterdata.edit', compact('articles'), [
            'materialsData' => $materialsData,
            'unitsData' => $unitsData,
            'error' => (!$materialsData || !$unitsData) ? 'One or more datasets failed to load' : null
        ]);
    }






    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return response()->json(['status' => 'success', 'message' => 'Article deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to delete this article.']);
        }
    }
}
