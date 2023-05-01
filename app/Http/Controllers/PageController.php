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
        $rules = [
            'date_created' => 'required|date',
            'username' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'current_quantity' => 'required|integer|min:1',
            'transfered_qty' => 'required|integer|min:1',
            'department' => 'required|string|max:255'
        ];
    
        $data = $request->validate($rules);

        $response = Http::post('https://dejavutechkenya.com/dejavuurls/dejavuurls.php', [
            'date_created' => $data['date_created'],
            'username' => $data['username'],
            'product' => $data['product'],
            'current_quantity' => $data['current_quantity'],
            'transfered_qty' => $data['transfered_qty'],
            'department' => $data['department']
        ]);

        return response()->json($response->json());
    }

    
}
