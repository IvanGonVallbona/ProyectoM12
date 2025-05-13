<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// MANUALS

Route::get('/manuals', [ApiController::class, 'listManual']);
Route::get('/manual/{id}', [ApiController::class, 'getManual']);
Route::post('/manual', [ApiController::class, 'crearManual']);
Route::put('/manual/{id}', [ApiController::class, 'editarManual']);
Route::delete('/manual/{id}', [ApiController::class, 'borrarManual']);
//Route::get('/videojoc/{id}/imatge', [ApiController::class, 'getVideojocImatge']);

// REGISTRES

Route::get('/registres', [ApiController::class, 'listRegistre']);
Route::get('/registre/{id}', [ApiController::class, 'getRegistre']);
Route::post('/registre', [ApiController::class, 'newRegistre']);
Route::put('/registre/{id}', [ApiController::class, 'editRegistre']);
Route::delete('/registre/{id}', [ApiController::class, 'deleteRegistre']);


// CLASSES

Route::get('/classes', [ApiController::class, 'listClasses']);
Route::get('/classe/{id}', [ApiController::class, 'getClasse']);
Route::post('/classe', [ApiController::class, 'newClasse']);
Route::put('/classe/{id}', [ApiController::class, 'editClasse']);
Route::delete('/classe/{id}', [ApiController::class, 'deleteClasse']);


// RAZAS

Route::get('/razas', [ApiController::class, 'indexRaza']);
Route::get('/raza/{id}', [ApiController::class, 'getRaza']);
Route::post('/raza', [ApiController::class, 'createRaza']);
Route::put('/raza/{id}', [ApiController::class, 'editRaza']);
Route::delete('/raza/{id}', [ApiController::class, 'destroyRaza']);


// ESDEVENIMENTS

Route::get('/esdeveniments', [ApiController::class, 'indexEsdeveniments']);
Route::get('/esdeveniment/{id}', [ApiController::class, 'getEsdeveniment']);
Route::post('/esdeveniment', [ApiController::class, 'createEsdeveniment']);
Route::put('/esdeveniment/{id}', [ApiController::class, 'editEsdeveniment']);
Route::delete('/esdeveniment/{id}', [ApiController::class, 'destroyEsdeveniment']);


// INSCRIPCIONS A ESDEVENIMENTS

Route::post('/esdeveniment/{esdeveniment}/inscriure', [ApiController::class, 'inscriureUsuari']);
Route::post('/esdeveniment/{esdeveniment}/desinscriure', [ApiController::class, 'desinscriureUsuari']);


// PERSONATGES

Route::get('/personatges', [ApiController::class, 'indexPersonatge']);
Route::get('/personatge/{id}', [ApiController::class, 'getPersonatge']);
Route::post('/personatge', [ApiController::class, 'createPersonatge']);
Route::put('/personatge/{id}', [ApiController::class, 'editPersonatge']);
Route::delete('/personatge/{id}', [ApiController::class, 'destroyPersonatge']);

// CAMPANYES

