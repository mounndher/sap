<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GroupeAcheteur;
use App\Models\GroupeArticle;
use App\Models\TypeArticle;
use App\Models\UserSap;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Mail\ArticleAddedMail;
use App\Mail\ValidteDonneédebaseMail;
use App\Models\Achat;
Use App\Models\Comptabilité;
use App\Models\Classv;
use App\Models\Mail_recipients;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    //

     public function __construct() {
          //$this->middleware(['permission:achat edit'])->only(['edit']);
          $this->middleware(['permission:achat update'])->only(['updateAchat']);
          $this->middleware(['permission:achat valider'])->only(['validerachat']);
          $this->middleware(['permission:achat invalider'])->only(['invaliderachat']);

         // $this->middleware(['permission:Comptabilité edit'])->only(['edit']);
          $this->middleware(['permission:Comptabilité update'])->only(['updateComptabilite']);
          $this->middleware(['permission:Comptabilité valider'])->only(['validercomptabilite']);
          $this->middleware(['permission:Comptabilité invalider'])->only(['invalidercomptabilite']);

          $this->middleware(['permission:edit Article'])->only(['edit']);
          $this->middleware(['permission:Article index'])->only(['index']);
          $this->middleware(['permission:Article create'])->only(['create', 'storeDonnesdebase']);
          $this->middleware(['permission:Article update'])->only(['updateDonnesdebase']);
          
          $this->middleware(['permission:Article delete'])->only(['destroy']);


    }
    public function index()
    {
        $articles = Article::with('typeArticle')->get();


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

        $typearticle = TypeArticle::where('status', 1)->get();


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
    $article->status = 0;
    $article->save();

    // ✅ Dispatch Pusher Event

    $recipients = Mail_recipients::where('status', 1)->pluck('email')->toArray();

    if (count($recipients) > 0) {
       // Mail::to($recipients)->send(new ArticleAddedMail($article));
    } else {
        return redirect()->back()->with([
            'message' => 'Aucun destinataire trouvé pour l\'envoi de l\'email.',
            'alert-type' => 'warning',
        ]);
    }

    return redirect()->route('articles.index', $article->id)->with([
        'message' => 'Article ajouté avec succès, email envoyé et notification en temps réel envoyée.',
        'alert-type' => 'success',
    ]);
}



   public function edit($id)
{
    $userSap = UserSap::first();

    if (!$userSap) {
        return view('backend.masterdata.create', [
            'materialsData' => null,
            'error' => 'SAP user credentials not found'
        ]);
    }

    $username = $userSap->username;
    $password = Crypt::decryptString($userSap->password);

    // SAP API URLs
    $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
    $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

    // Materials data
    try {
        $materialsResponse = Http::withBasicAuth($username, $password)
            ->timeout(30)
            ->get($maktUrl);

        $materialsData = $materialsResponse->successful()
            ? $materialsResponse->json()['d']['results'] ?? []
            : [];

    } catch (\Exception $e) {
        $materialsData = [];
        Log::error('Failed to fetch materials data: ' . $e->getMessage());
    }

    // Units data
    try {
        $unitsResponse = Http::withBasicAuth($username, $password)
            ->timeout(30)
            ->get($t006aUrl);

        $unitsData = $unitsResponse->successful()
            ? $unitsResponse->json()['d']['results'] ?? []
            : [];

    } catch (\Exception $e) {
        $unitsData = [];
        Log::error('Failed to fetch units data: ' . $e->getMessage());
    }

    $article = Article::with('comptabilite')->findOrFail($id);
    $groupeAcheteur = GroupeAcheteur::all();
    $groupes = $article->MTART ? GroupeArticle::where('type_article_id', $article->MTART)->get() : [];
    $classes_valoris = Classv::where('type_article_id', $article->MTART)->get();
    $achat = Achat::where('article_id', $id)->first();
    $typearticle = TypeArticle::where('status', 1)->get();
    $comp = Comptabilité::where('article_id', $id)->first();

    return view('backend.masterdata.edit', [
        'articles' => $article,
        'materialsData' => $materialsData,
        'unitsData' => $unitsData,
        'comp' => $comp,
        'groupeAcheteur' => $groupeAcheteur,
        'typearticle' => $typearticle,
        'groupes' => $groupes,
        'classes_valoris' => $classes_valoris,
        'achat' => $achat,
        'error' => (empty($materialsData) || empty($unitsData)) ? 'One or more datasets failed to load' : null
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
            //'EKGRP' => 'required',
        ]);

        $article = Article::findOrFail($id);

        $typearticle = TypeArticle::where('status', 1)->get();
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
        // $article->EKGRP = $request->EKGRP; // uncomment if needed
        $article->save();

        return redirect()->route('articles.index')->with([
            'message' => 'Article mis à jour avec succès.',
            'alert-type' => 'success',
             'active_tab' => 'general'
        ]);
    }

 public function updateAchat(Request $request, $id = null)
{
    $request->validate([
        'BSTME' => 'required',
        'article_id' => 'required|exists:articles,id',
        'groupe_acheteurs_id' => 'required|exists:groupe_acheteurs,id',
    ]);

    $article = Article::findOrFail($request->article_id);
    if ($article->status == 0) {
        return redirect()->back()->with([
            'message' => "Impossible d'ajouter des données : l'article est inactif.",
            'active_tab' => 'achat',
            'alert-type' => 'warning',
        ]);
    }

    // If ID is provided, update existing Achat by its ID
    if ($id) {
        $achat = Achat::findOrFail($id);
        $achat->update([
            'BSTME' => $request->BSTME,
            'from' => $request->from,
            'to' => $request->to,
            'status' => 0,
            'article_id' => $request->article_id,
            'groupe_acheteurs_id' => $request->groupe_acheteurs_id,
        ]);
    } else {
        // Otherwise, create or update by article_id
        Achat::updateOrCreate(
            ['article_id' => $request->article_id],
            [
                'BSTME' => $request->BSTME,
                'from' => $request->from,
                'to' => $request->to,
                'status' => 0,
                'groupe_acheteurs_id' => $request->groupe_acheteurs_id,
            ]
        );
    }

    return redirect()->route('articles.edit', $request->article_id)
        ->with([
            'message' => "Les paramètres d'achat ont été enregistrés avec succès!",
            'alert-type' => 'success',
            'active_tab' => 'achat'
        ]);
}




    public function updateComptabilite(Request $request,$id=null)
    {
        //dd($request->all());
        $request->validate([
            'classe_valoris_id' => 'nullable',
            'code_prix' => 'required',
        ]);
        $article = Article::findOrFail($request->article_id);
        if ($article->status == 0) {
        return redirect()->back()->with([
            'message' => "Impossible d'ajouter des données : l'article est inactif.",
            'active_tab' => 'comptabilite',
            'alert-type' => 'warning',
        ]);
    }

         Comptabilité::updateOrCreate(
        ['article_id' => $request->article_id],
        [
            'classe_valoris_id' => $request->classe_valoris_id,
            'code_prix' => $request->code_prix,
            'status'=>0,
        ]
    );



        return redirect()->route('articles.edit', $request->article_id)->with([
            'message' => "Comptabilite updated successfully!",
            'alert-type' => 'success',
            'active_tab' => 'comptabilite'
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


    public function getGroupes($typeArticleId)
    {
        $groupes = GroupeArticle::where('type_article_id', $typeArticleId)->get();

        // Return JSON response
        return response()->json($groupes);
    }

    public function getGroupesByType(Request $request)
    {
        $typeId = $request->input('type_id');

        if (!$typeId) {
            return response()->json([]);
        }

        $groupes = GroupeArticle::where('type_article_id', $typeId)->get();

        return response()->json($groupes);
    }



    public function validerdonnesdebase($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 1;
        $article->save();
        $recipients = Mail_recipients::where('validtion', 1)->pluck('email')->toArray();
        // Send email to all recipients
        if (count($recipients) > 0) {
            Mail::to($recipients)->send(new ValidteDonneédebaseMail($article));
        } else {
            // Handle case where no recipients are found
            return redirect()->back()->with([
                'message' => 'Aucun destinataire trouvé pour l\'envoi de l\'email.',
                'alert-type' => 'warning',
            ]);
        }


        return response()->json([
            'message' => 'Données de base validées avec succès.'
        ]);
    }

    public function invaliderdonnesdebase($id){
    $article = Article::findOrFail($id);
    $article->status = 0;
    $article->save();

    return response()->json([
        'message' => 'Données de base invalidées avec succès.'
    ]);
}

   public function validerachat($id)
{
    $article = Achat::findOrFail($id);
    $article->status = 1;
    $article->save();




    return response()->json([
        'message' => 'Achat validées avec succès.'
    ]);
}

public function invaliderachat($id){
    $article =  Achat::findOrFail($id);
    $article->status = 0;
    $article->save();

    return response()->json([
        'message' => 'Achat invalidées avec succès.'
    ]);
}

public function validercomptabilite($id)
{
    $article = Comptabilité::findOrFail($id);
    $article->status = 1;
    $article->save();

    return response()->json([
        'message' => 'Comptabilité validées avec succès.'
    ]);
}

public function invalidercomptabilite($id){
    $article = Comptabilité::findOrFail($id);
    $article->status = 0;
    $article->save();

    return response()->json([
        'message' => 'Comptabilité invalidées avec succès.'
    ]);
}


public function validtionarticletotale($id)
{
    Log::info('Validation totale called for article ID: ' . $id);

    $article = Article::findOrFail($id);
    $achat = Achat::where('article_id', $id)->first();
    $comptabilite = Comptabilité::where('article_id', $id)->first();

    Log::info('Statuses:', [
        'article_status' => $article->status,
        'achat_status' => optional($achat)->status,
        'comptabilite_status' => optional($comptabilite)->status,
    ]);

    if (
        $article->status == 1 &&
        $achat && $achat->status == 1 &&
        $comptabilite && $comptabilite->status == 1
    ) {
        $article->statustotal = 1;
        $article->save();

        return response()->json([
            'message' => 'Article totalement validé avec succès.',
            'statustotal' => $article->statustotal
        ]);
    } else {
        return response()->json([
            'message' => 'Impossible de valider totalement l\'article. Vérifiez que toutes les étapes sont validées.',
            'statustotal' => $article->statustotal ?? 0
        ], 422);
    }
}
}
