<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PageController extends Controller
{
    public function createRecordPage()
    {
        return view('createRecord');
    }

    public function viewRecords()
    {
        // Make a GET request to the API endpoint to fetch the records
        // $url = 'https://dejavutechkenya.com/dejavuurls/dejavurecs.php';
        // $url = '/dejavurecs.php';
        // $result = file_get_contents($url);

        // Parse the JSON response into an array
        // $records = json_decode($result, true);
        $records = Page::all();

        // Return the view with the records data
        // return view('viewRecords', ['records' => $records]);
        return view('viewRecords' , ['records' => $records]);
    }

    public function getRecords()
    {
        $results = Page::all();
        $records = json_encode($results, true);
        return view('record', ['records' => $records]);
    }

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

        $url = "";
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

    public function store(Request $request)
    {
        // validate 
        $formFields = $request->validate([
            'date_created' => 'required',
            'username' => 'required|string',
            'product' => 'required|string',
            'current_quantity' => 'required|integer',
            'transfered_qty' => 'required|integer',
            'department' => 'required|string'
        ]);

        $date_created = Carbon::parse($formFields['date_created'])->format('Y-m-d H:i:s');
        $formFields['date_created'] = $date_created;

        Page::create($formFields);

        return redirect('/view-records');
    }

    
}
