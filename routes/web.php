<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::get('/redirection', function () {
    $utilisateur = Auth::user();

    if ($utilisateur->role == 'avocat') {
        return redirect('/avocat/tableau-de-bord');
    } else {
        return redirect('/client/tableau-de-bord');
    }
})->middleware(['auth']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard client
Route::get('/client/tableau-de-bord', function () {
    return view('client.tableau-de-bord');
})->middleware(['auth']);

// Dashboard avocat
Route::get('/avocat/tableau-de-bord', function () {
    return view('avocat.tableau-de-bord');
})->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('accueil');
})->name('accueil');