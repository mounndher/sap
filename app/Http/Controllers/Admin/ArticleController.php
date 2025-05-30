<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Achat;
use App\Models\GroupeArticle;
use App\Models\TypeArticle;
use App\Models\UserSap;
use Illuminate\Support\Facades\Crypt;
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

        $userSap = UserSap::first(); // Assuming you have a UserSap model to fetch SAP credentials
        if (!$userSap) {
            return view('backend.masterdata.create', ['materialsData' => null, 'error' => 'SAP user credentials not found']);
        }

        // Use the credentials from the UserSap model
        $username = $userSap->username;

        $password = Crypt::decryptString($userSap->password);
        $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
        $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

        $materialsResponse = Http::withBasicAuth($username, $password)->get($maktUrl);
        $materialsData = $materialsResponse->successful() ? $materialsResponse->json()['d']['results'] ?? [] : null;
         //dd($materialsData);
        $unitsResponse = Http::withBasicAuth($username, $password)->get($t006aUrl);
        $unitsData = $unitsResponse->successful() ? $unitsResponse->json()['d']['results'] ?? [] : null;

       $typearticle=TypeArticle::where('status', 1)->get();


        return view('backend.masterdata.create', [
            'materialsData' => $materialsData,
            'unitsData' => $unitsData,
            'typearticle' => $typearticle,
            'error' => (!$materialsData || !$unitsData) ? 'One or more datasets failed to load' : null,


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
           // 'EKGRP' => 'required',
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
        //$article->EKGRP = $request->EKGRP;
        $article->save();

        // Redirect to create with article_id and step=achat to show Achat tab
       return redirect()->route('articles.index')->with('article_id', $article->id);
    }







    public function edit($id)
    {
        $articles = Article::findOrFail($id);
         $username = env('SAP_USER', 'eriache');
        $password = env('SAP_PASS', 'Mondher125');
        $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

        // Second URL - T006ASet (Units)
        $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

        // Fetch materials data
        $materialsResponse = Http::withBasicAuth( $username, $password)->get($maktUrl);
        $materialsData = $materialsResponse->successful()
            ? $materialsResponse->json()['d']['results'] ?? []
            : null;

        // Fetch units data
        $unitsResponse = Http::withBasicAuth($username, $password)->get($t006aUrl);
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
    public function updateDonnesdebase(Request $request, $id)
{
    $request->validate([
        'MAKTX' => 'required|string|max:40',
        'MTART' => 'required|string|max:4',
        'MATKL' => 'required|string|max:9',
        'MEINS' => 'required',
        'XCHPF' => 'required',
        'EKGRP' => 'required',
    ]);

    $article = Article::findOrFail($id);

    // Check for uniqueness of MAKTX only if it's changed
    if ($request->MAKTX !== $article->MAKTX) {
        $exists = Article::where('MAKTX', $request->MAKTX)->first();
        if ($exists) {
            return redirect()->back()->with([
                'message' => 'Désolé, le Designation est déjà enregistré.',
                'alert-type' => 'error',
            ])->withInput();
        }
    }

    $article->MTART = $request->MTART;
    $article->MATKL = $request->MATKL;
    $article->MEINS = $request->MEINS;
    $article->XCHPF = $request->XCHPF;
    $article->MAKTX = $request->MAKTX;
     $article->EKGRP = $request->EKGRP; // uncomment if needed
    $article->save();

    return redirect()->route('articles.index')->with([
        'message' => 'Article mis à jour avec succès.',
        'alert-type' => 'success',
    ]);
}

   public function updateAchat(Request $request,  $id)
    {
        $request->validate([
            'BSTME' => 'required',
        ]);

        $achat = Article::findOrFail($id);
        $achat->update([

            'BSTME' => $request->BSTME,
        ]);

        return redirect()->route('articles.index')->with('success', 'Achat updated successfully');

    }
    public function updateComptabilite(Request $request,  $id)
    {
        //dd($request->all());
        $request->validate([
            'VPRSV_1' => 'required',
            'BKLAS' => 'required',
        ]);

        $Comptabilite = Article::findOrFail($id);
        $Comptabilite->update([

            'VPRSV_1' => $request->VPRSV_1,
            'BKLAS' => $request->BKLAS,

        ]);

        return redirect()->route('articles.index')->with('success', 'Comptabilite updated successfully');

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


    public function getGroupes($typeArticleId)
{
    $groupes = GroupeArticle::where('type_article_id', $typeArticleId)->get();

    // Return JSON response
    return response()->json($groupes);
}
}
