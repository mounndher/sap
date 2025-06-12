<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserSap;
use Illuminate\Support\Facades\Log;
 // Assuming you have a UserSap model for SAP credentials
class SapController extends Controller
{
    //


public function getMaterials()
{
    $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";
    $username = env('SAP_USER');
    $password = env('SAP_PASS');

    if (!$username || !$password) {
        return response()->json(['error' => 'SAP credentials not set'], 500);
    }

    $response = Http::withBasicAuth($username, $password)->get($url);

    Log::info('SAP Response Status: ' . $response->status());
    Log::info('SAP Response Body: ' . $response->body());

    if ($response->successful()) {
        return response()->json($response->json());
    }

    return response()->json([
        'error' => 'Failed to fetch data',
        'status' => $response->status(),
        'body' => $response->body()
    ], 500);
}






    public function showMaterials()
    {

        $userSap = UserSap::first(); // Assuming you have a UserSap model to fetch SAP credentials
        if (!$userSap) {
            return view('we', ['materialsData' => null, 'error' => 'SAP user credentials not found']);
        }

        // Use the credentials from the UserSap model
        $username = $userSap->username;
        $password = Crypt::decryptString($userSap->password); // Use directly, but will fail in Basic Auth if hashed

        // Or just debug:
        //dd($password);
        $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MAKTSet?\$format=json";

        $response = Http::withBasicAuth($username, $password)->get($url);


        if ($response->successful()) {
            $sapData = $response->json(); // Full JSON from SAP

            // Pass the entire JSON to the view in a variable called 'materialsData'
            return view('we', ['materialsData' => $sapData]);
        }

        // In case of error, pass empty or error info
        return view('we', ['materialsData' => null, 'error' => 'Failed to fetch data']);
    }
    public function showuinte()
    {
        $url = "http://lnxs4hprdapp.local.pharma:8000/sap/opu/odata/SAP/Z_GETMASTERDATA_SRV/MARASet?\$format=json";

        $response = Http::withBasicAuth(env('SAP_USER'), env('SAP_PASS'))
            ->get($url);

        if ($response->successful()) {
            $sapData = $response->json(); // Full JSON from SAP

            // Pass the entire JSON to the view in a variable called 'materialsData'
            return view('we2', ['materialsData' => $sapData]);
        }

        // In case of error, pass empty or error info
        return view('we2', ['materialsData' => null, 'error' => 'Failed to fetch data']);
    }

    // In your controller
    public function viewMaterials(Request $request)
    { {
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
