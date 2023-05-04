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


    public function submitRecord(Request $request)
    {
        
        // $rules = [
        //     'date_created' => 'required|date',
        //     'username' => 'required|string|max:255',
        //     'product' => 'required|string|max:255',
        //     'current_quantity' => 'required|integer|min:1',
        //     'transfered_qty' => 'required|integer|min:1',
        //     'department' => 'required|string|max:255'
        // ];
    
        // $data = $request->validate($rules);

        // $json_data = [
        //     'date_created' => $data['date_created'],
        //     'username' => $data['username'],
        //     'product' => $data['product'],
        //     'current_quantity' => $data['current_quantity'],
        //     'transfered_qty' => $data['transfered_qty'],
        //     'department' => $data['department']
        // ];

        // $response = Http::post('https://dejavutechkenya.com/dejavuurls/dejavuurls.php', $json_data);

        // return response()->json($response->json());

        $validatedData = $request->validate([
            'date_created' => 'required|date',
            'username' => 'required|string',
            'product_name' => 'required|string',
            'current_quantity' => 'required|integer',
            'transfer_quantity' => 'required|integer',
            'department_name' => 'required|string',
        ]);

        if(!$validatedData){
            var_dump("Noo");
        }
    
        $url = "https://dejavutechkenya.com/dejavuurls/dejavuurls.php";
        $data = [
            'date_created' => $validatedData['date_created'],
            'username' => $validatedData['username'],
            'product' => $validatedData['product'],
            'current_quantity' => $validatedData['current_quantity'],
            'transfered_qty' => $validatedData['transfererd_qty'],
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
        Log::info( response()->json($result));
    
        return response()->json($result);
    }

    
}
