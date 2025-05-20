<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CampanyaController;
use App\Http\Controllers\RegistreController;
use App\Http\Controllers\EsdevenimentController;
use App\Http\Controllers\PersonatgeController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\ManualController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('default/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', [DefaultController::class, 'home'])->name('home');



// CLASSES
Route::get('/classes/list', [ClasseController::class,'list'])->name('classe_list');
Route::match(['get', 'post'], '/classe/new', [ClasseController::class, 'new'])->name('classe_new');
Route::match(['get', 'post'], '/classe/edit/{id}', [ClasseController::class, 'edit'])->name('classe_edit');
Route::delete('/classe/delete/{id}', [ClasseController::class, 'delete'])->name('classe_delete');

// CAMPANYES

Route::get('/campanyes/list', [CampanyaController::class, 'list'])->name('campanya_list');
Route::match(['get', 'post'], '/campanya/new', [CampanyaController::class, 'new'])->name('campanya_new');
Route::match(['get', 'post'], '/campanya/edit/{id}', [CampanyaController::class, 'edit'])->name('campanya_edit');
Route::delete('/campanya/delete/{id}', [CampanyaController::class, 'delete'])->name('campanya_delete');
Route::get('/campanya/{id_campanya}/add-personatge', [CampanyaController::class, 'addPersonatge'])->name('campanya.addPersonatge');
Route::post('/campanya/{id_campanya}/add-personatge/{id_personatge}', [CampanyaController::class, 'addPersonatgeToCampanya'])->name('campanya.addPersonatgeToCampanya');
Route::get('/campanya/{id}', [CampanyaController::class, 'show'])->name('campanya.show');

// REGISTRES
Route::get('/registres/list', [RegistreController::class, 'list'])->name('registre_list');
Route::match(['get', 'post'], '/registre/new', [RegistreController::class, 'new'])->name('registre_new');
Route::match(['get', 'post'], '/registre/edit/{id}', [RegistreController::class, 'edit'])->name('registre_edit');
Route::delete('/registre/delete/{id}', [RegistreController::class, 'delete'])->name('registre_delete');
Route::match(['get', 'post'], '/registre/edit/campanya/{campanya_id}', [RegistreController::class, 'editByCampanya'])->name('registre_edit_by_campanya');
// MANUALS
Route::get('/manuals/list', [ManualController::class, 'list'])->name('manual_list');
Route::match(['get', 'post'], '/manual/new', [ManualController::class, 'new'])->name('manual_new');
Route::match(['get', 'post'], '/manual/edit/{id}', [ManualController::class, 'edit'])->name('manual_edit');
Route::delete('/manual/delete/{id}', [ManualController::class, 'delete'])->name('manual_delete');
Route::get('/manuals/{manual}', [App\Http\Controllers\ManualController::class, 'show'])->name('manual_show');


// ESDEVENIMENTS
Route::resource('esdeveniments', EsdevenimentController::class)
    ->name('index', 'esdeveniments.index');

Route::post('/esdeveniments/{esdeveniment}/inscriure-usuari', [EsdevenimentController::class, 'inscriureUsuari'])->name('esdeveniments.inscriureUsuari');
Route::post('/esdeveniments/{esdeveniment}/desinscriure-usuari', [EsdevenimentController::class, 'desinscriureUsuari'])->name('esdeveniments.desinscriureUsuari');

// PERSONATGES
Route::resource('personatges', PersonatgeController::class)
    ->name('index', 'personatges.index');

// RAZAS
Route::resource('razas', RazaController::class);

// EVENTS
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');


require __DIR__.'/auth.php';
 
