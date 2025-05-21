<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class SapController extends Controller
{
    //
    public function getMaterials()
{
   $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

    $response = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($url);


    if ($response->successful()) {
        return response()->json($response->json());
    }

    return response()->json(['error' => 'Failed to fetch data'], 500);
}


public function showMaterials()
{
    $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

    $response = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))
                    ->get($url);

    if ($response->successful()) {
        $sapData = $response->json(); // Full JSON from SAP

        // Pass the entire JSON to the view in a variable called 'materialsData'
        return view('we', ['materialsData' => $sapData]);
    }

    // In case of error, pass empty or error info
    return view('we', ['materialsData' => null, 'error' => 'Failed to fetch data']);
}

// In your controller
public function viewMaterials(Request $request)
{
   {
    $search = $request->query('search'); // e.g. ?search=app

    $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

    $response = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))->get($url);

    if ($response->successful()) {
        $sapData = $response->json(); // Full JSON

        $materials = $sapData['d']['results'];

        // Apply filtering if a search is provided
        if ($search) {
            $search = strtolower($search);
            $materials = array_filter($materials, function ($item) use ($search) {
                return stripos($item['Maktx'], $search) !== false || stripos($item['Matnr'], $search) !== false;
            });
        }

        return view('we1', [
            'materialsData' => ['d' => ['results' => array_values($materials)]],
            'search' => $request->query('search')
        ]);
    }

    return view('we1', ['materialsData' => null, 'error' => 'Failed to fetch data']);
}
}



}
