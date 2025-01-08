<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApotekController;
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


Route::get('/Apotek', [ApotekController::class, 'index']);

Route::get('/user', function (Request $request) {
    return response()->json(['message' => 'Public access']);
});


Route::get('/apotek', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API Laravel Terhubung!'
    ]);
});
