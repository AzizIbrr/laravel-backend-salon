<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TreatmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/locations', App\Http\Controllers\Api\LocationController::class);
Route::get('treatments', [TreatmentController::class, 'getTreatmentByLocation']);
Route::post('get-therapist', [TreatmentController::class, 'getTherapistByTreatment']);
Route::post('save-booking', [App\Http\Controllers\Api\BookingController::class, 'store']);