<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/create-record');
});

Route::post('/submit-record', [PageController::class, 'submitRecord']);
Route::get('/view-records', [PageController::class, 'viewRecords']);
Route::get('/create-record', [PageController::class, 'createRecordPage']);
Route::post('/save-record', [PageController::class, 'store']); 
Route::get('/records', [PageController::class, 'getRecords']);



