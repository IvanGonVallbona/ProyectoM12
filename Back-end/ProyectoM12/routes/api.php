<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// MANUALS

Route::get('/manuals', [ApiController::class, 'llistaManuals']);
Route::get('/manual/{id}', [ApiController::class, 'llistaManual']);
Route::post('/manual', [ApiController::class, 'crearManual']);
Route::put('/manual/{id}', [ApiController::class, 'editarManual']);
Route::delete('/manual/{id}', [ApiController::class, 'borrarManual']);
//Route::get('/videojoc/{id}/imatge', [ApiController::class, 'getVideojocImatge']);

// REGISTRES

