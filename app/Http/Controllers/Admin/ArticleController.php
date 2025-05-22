<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index(){
        return view('backend.masterdata.index');
    }
    public function create(){
    $urlarticle = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
    $urlunite = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/T006Set?\$format=json";

    $responseArticle = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($urlarticle);
    $responseUnite = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($urlunite);

if ($responseArticle->successful() && $responseUnite->successful()) {
        $materialsData  = $responseArticle->json();
        $unitData = $responseUnite->json();

        // Pass the entire JSON to the view in a variable called 'materialsData'
        return view('backend.masterdata.create', ['materialsData' => $materialsData , 'unitData' => $unitData]);
    }

    // In case of error, pass empty or error info
    return view('backend.masterdata.create', ['materialsData' => null, 'error' => 'Failed to fetch data']);

    }

}
