<?php

use App\Http\Controllers\ConferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/con', [ConferenceController::class, 'store']);
