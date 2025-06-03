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
use App\Models\Mail_recipients;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    //
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
        $article->status = $request->status ?? 0;
        $article->save();
        //dd($article);

        // Redirect to create with article_id and step=achat to show Achat tab

        // ✅ Fetch all recipient emails $recipients = Mail_recipient::where('status', 1)->pluck('email')->toArray();

        $recipients = Mail_recipients::where('status', 1)->pluck('email')->toArray();
        // Send email to all recipients
        if (count($recipients) > 0) {
            Mail::to($recipients)->send(new ArticleAddedMail($article));
        } else {
            // Handle case where no recipients are found
            return redirect()->back()->with([
                'message' => 'Aucun destinataire trouvé pour l\'envoi de l\'email.',
                'alert-type' => 'warning',
            ]);
        }

        return redirect()->route('articles.index', $article->id);
    }


    public function edit($id)
    {
        $userSap = UserSap::first(); // Assuming you have a UserSap model to fetch SAP credentials
        if (!$userSap) {
            return view('backend.masterdata.create', ['materialsData' => null, 'error' => 'SAP user credentials not found']);
        }

        // Use the credentials from the UserSap model
        $username = $userSap->username;

        $password = Crypt::decryptString($userSap->password);
        $article = Article::findOrFail($id);
        $groupeAcheteur = GroupeAcheteur::all();


        // SAP API endpoints
        $maktUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
        $t006aUrl = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/t006aSet?\$format=json";

        // Fetch materials data with error handling
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

        // Fetch units data with error handling
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

        // Get active article types
        $typearticle = TypeArticle::where('status', 1)->get();

        // Get groups for the article's current type
        $groupes = [];
        if ($article->MTART) {
            $groupes = GroupeArticle::where('type_article_id', $article->MTART)->get();
        }

         $achat = Achat::where('article_id', $id)->first();
        return view('backend.masterdata.edit', [
            'articles' => $article, // Keeping your original variable name
            'materialsData' => $materialsData,
            'groupeAcheteur' => $groupeAcheteur,
            'typearticle' => $typearticle,
            'groupes' => $groupes,
            'unitsData' => $unitsData,
            'achat'=>$achat,
            'error' => (empty($materialsData) || empty($unitsData)
                ? 'One or more datasets failed to load'
                : null)
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
        ]);
    }

  public function updateAchat(Request $request)
{
    $request->validate([
        'BSTME' => 'required',
        'article_id' => 'required|exists:articles,id',
        'groupe_acheteurs_id'=> 'required|exists:groupe_acheteurs,id',
    ]);

    $achat = Achat::updateOrCreate(
        ['article_id' => $request->article_id],  // شرط البحث
        [
            'BSTME' => $request->BSTME,
            'from' => $request->from,
            'groupe_acheteurs_id' => $request->groupe_acheteurs_id,
            'to' => $request->to,
        ]
    );

    return response()->json(['message' => 'Achat created or updated successfully', 'achat' => $achat]);
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
}
