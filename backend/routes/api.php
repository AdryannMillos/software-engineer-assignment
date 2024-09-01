<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DispositionsController;

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

Route::group(['prefix' => 'candidates'], function () {
    Route::get('/', [CandidateController::class, 'index']);
    Route::post('/', [CandidateController::class, 'store']);
    Route::get('/{id}', [CandidateController::class, 'show']);
    Route::put('/{id}', [CandidateController::class, 'update']);
    Route::delete('/{id}', [CandidateController::class, 'destroy']);
});

Route::group(['prefix' => 'dispositions'], function () {
    Route::get('/', [DispositionsController::class, 'index']);
    Route::post('/', [DispositionsController::class, 'store']);
    Route::get('/{id}', [DispositionsController::class, 'show']);
    Route::put('/{id}', [DispositionsController::class, 'update']);
    Route::delete('/{id}', [DispositionsController::class, 'destroy']);
});
