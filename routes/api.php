<?php

use App\Http\Controllers\MpstatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/files', [MpstatsController::class, 'getFiles']);
Route::get('/categories', [MpstatsController::class, 'getCategories']);
Route::post('/category', [MpstatsController::class, 'getCategory']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


