<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json(['message' => 'Live!'], 200);
});
Route::get('candidates', [CandidateController::class, 'index']);
Route::post('candidate', [CandidateController::class, 'store']);
Route::get('candidate/{id}', [CandidateController::class, 'show']);
Route::put('candidate/{id}', [CandidateController::class, 'update']);
Route::delete('candidate/{id}', [CandidateController::class, 'destroy']);
