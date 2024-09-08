<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommitteeMemberController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\ConferenceImageController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\ScientificPaperController;
use App\Http\Controllers\ScientificTopicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// user
Route::post('/user', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);



// conference
// Route::post('/con', [ConferenceController::class, 'store']);
// Route::get('/con', [ConferenceController::class, 'getAllConferences']);
Route::get('/con/{status}', [ConferenceController::class, 'getConferenceByStatus']);

Route::get('/con/id/{id}', [ConferenceController::class, 'getConferenceById']);
Route::post('/con/img/{conference_id}', [ConferenceImageController::class, 'store']);
// Route::get('/con/img/{conference_id}', [ConferenceImageController::class, 'getByConference']);
Route::post('/con/committee', [CommitteeMemberController::class, 'store']);
// Route::get('/con/committee/{conference_id}', [CommitteeMemberController::class, 'getByConference']);

Route::post('/con/topic', [ScientificTopicController::class, 'store']);
// Route::get('/con/stopic/{id}', [ScientificTopicController::class, 'show']);
Route::delete('/con/stopic/{id}', [ScientificTopicController::class, 'destroy']);

Route::post('/con/{conference_id}/prices', [PricesController::class, 'store']);
Route::delete('/con/{conference_id}/{price_id}/prices', [PricesController::class, 'deletePriceByConferenceId']);
// Route::get('/con/{conference_id}/prices', [PricesController::class, 'getPricesByConferenceId']);


// Route::post('/con/scientific-papers/{conferenceId}', [ScientificPaperController::class, 'store'])->middleware('auth');

Route::post('/con/scientific-papers/{conferenceId}', [ScientificPaperController::class, 'store']);


Route::post('/exhibitions', [ExhibitionController::class, 'store']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/con', [ConferenceController::class, 'store']);
});
// Route::post('/con', [ConferenceController::class, 'store'])->middleware(['sanctum', CheckAdmin::class]);


