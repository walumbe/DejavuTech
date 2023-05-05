<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function createRecordPage()
    {
        return view('createRecord');
    }

    public function viewRecords()
    {
        // Make a GET request to the API endpoint to fetch the records
        $url = 'https://dejavutechkenya.com/dejavuurls/dejavurecs.php';
        $result = file_get_contents($url);

        // Parse the JSON response into an array
        $records = json_decode($result, true);

        // Return the view with the records data
        return view('viewRecords', ['records' => $records]);
    }


    // public function submitRecord(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'date_created' => 'required|date',
    //         'username' => 'required|string',
    //         'product' => 'required|string',
    //         'current_quantity' => 'required|integer',
    //         'transfered_qty' => 'required|integer',
    //         'department' => 'required|string',
    //     ]);
    
    //     $url = "https://dejavutechkenya.com/dejavuurls/dejavuurls.php";
    //     $data = [
    //         'date_created' => $validatedData['date_created'],
    //         'username' => $validatedData['username'],
    //         'product' => $validatedData['product'],
    //         'current_quantity' => $validatedData['current_quantity'],
    //         'transfered_qty' => $validatedData['transfered_qty'],
    //         'department' => $validatedData['department'],
    //     ];
    
    //     $options = [
    //         'http' => [
    //             'header' => "Content-Type: application/json\r\n",
    //             'method' => 'POST',
    //             'content' => json_encode($data),
    //         ],
    //     ];
    
    //     $context = stream_context_create($options);
    //     $result = file_get_contents($url, false, $context);
    //     Log::info($result);
    
    //     return response()->json($result);
    // }
//     public function submitRecord(Request $request)
// {
//     $validatedData = $request->validate([
//         'date_created' => 'required|date',
//         'username' => 'required|string',
//         'product' => 'required|string',
//         'current_quantity' => 'required|integer',
//         'transfered_qty' => 'required|integer',
//         'department' => 'required|string',
//     ]);

//     $url = "https://dejavutechkenya.com/dejavuurls/dejavuurls.php";
//     $data = [
//         'date_created' => $validatedData['date_created'],
//         'username' => $validatedData['username'],
//         'product' => $validatedData['product'],
//         'current_quantity' => $validatedData['current_quantity'],
//         'transfered_qty' => $validatedData['transfered_qty'],
//         'department' => $validatedData['department'],
//     ];

//     $response = Http::post($url, $data);

//     $jsonResponse = $response->json();

//     Log::info($jsonResponse);

//     return response()->json($jsonResponse);
// }

public function submitRecord(Request $request)
{
    $validatedData = $request->validate([
        'date_created' => 'required|date',
        'username' => 'required|string',
        'product' => 'required|string',
        'current_quantity' => 'required|integer',
        'transfered_qty' => 'required|integer',
        'department' => 'required|string',
    ]);

    $url = "https://dejavutechkenya.com/dejavuurls/dejavuurls.php";
    $data = [
        'date_created' => $validatedData['date_created'],
        'username' => $validatedData['username'],
        'product' => $validatedData['product'],
        'current_quantity' => $validatedData['current_quantity'],
        'transfered_qty' => $validatedData['transfered_qty'],
        'department' => $validatedData['department'],
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    Log::info($result);

    return response()->json(json_decode($result));
}



    
}
