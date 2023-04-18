<?php

// PROFILE
use App\Http\Controllers\ProfileController;

// ADMIN
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TypeController;

// GUEST
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// # GUEST ROUTES

Route::get('/', [GuestHomeController::class, 'index']);

Route::resource('projects', GuestProjectController::class);

// # ADMIN ROUTES

// projects routes
Route::get('/home', [AdminHomeController::class, 'index'])->middleware('auth')->name('home');

// types routes all resources (not working)
// Route::resource('types', TypeController::class);

// * (TYPE) Rotta per la lista index (TYPE)
Route::get('/types', [TypeController::class, 'index'])->middleware('auth')->name('types');

// * (TYPE) Rotta per il dettaglio risorsa show
Route::get('/types/{type}', [TypeController::class, 'show'])->name('types.show');

// * (TYPE) Rotta per il form creazione risorsa
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');

// * (TYPE) Rotta per il salvataggio form creazione risorsa
Route::get('/types', [TypeController::class, 'store'])->name('types.store');

// * (TYPE) Rotta per il form di modifica risorsa
Route::get('/types/{record}/edit', [TypeController::class, 'edit'])->name('types.edit');

// * (TYPE) Rotta per il form di modifica risorsa
Route::put('/types/{record}/update', [TypeController::class, 'update'])->name('types.update');

// * (TYPE) Rotta per cancellazione risorsa singola
Route::delete('/types/{type}/destroy', [TypeController::class, 'destroy'])->name('types.destroy');

Route::middleware('auth')
->prefix('/Admin')
->name('admin.')
->group(function () {
    Route::Resource('projects', AdminProjectController::class);
});

Route::middleware('auth')
->prefix('profile') // * TUTTI GLI URL HANNO PREFISSO = PROFILE
->name('profile.') // * TUTTI I NOMI DELLE ROTTE HANNO PREFISSO = PROFILE
->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

// * AGGIUNGO PREFISSO E NAME UNA VOLTA SOLA VISTO CHE UGUALE PER TUTTE LE ROTTE
// Route::middleware('auth')
// ->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';