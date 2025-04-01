<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EsdevenimentController;

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

Route::get('/classe/delete/{id}', [ClasseController::class, 'delete'])->name('classe_delete');


// EVENTS
Route::resource('esdeveniments', EsdevenimentController::class)
    ->name('index', 'esdeveniments.index');

require __DIR__.'/auth.php';
