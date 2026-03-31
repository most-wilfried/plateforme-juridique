<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LawyerProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'avocat' => redirect()->route('avocat.dashboard'),
        'client' => redirect()->route('client.dashboard'),
        'admin' => redirect()->route('admin.dashboard'),
        default => redirect()->route('client.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'approved'])->group(function () {
    Route::get('/client/tableau-de-bord', [DashboardController::class, 'client'])
        ->middleware('role:client')
        ->name('client.dashboard');

    Route::get('/avocat/tableau-de-bord', [DashboardController::class, 'avocat'])
        ->middleware('role:avocat')
        ->name('avocat.dashboard');

    Route::get('/admin/tableau-de-bord', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/admin/avocats/attente-validation', [\App\Http\Controllers\Admin\LawyerApprovalController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.lawyers.pending');

    Route::post('/admin/avocats/{lawyer}/approuver', [\App\Http\Controllers\Admin\LawyerApprovalController::class, 'approve'])
        ->middleware('role:admin')
        ->name('admin.lawyers.approve');

    Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');

    Route::get('/messages/{user}', [MessageController::class, 'show'])
        ->name('messages.show');

    Route::post('/messages/{user}', [MessageController::class, 'store'])
        ->name('messages.store');

    Route::get('/documents', [DocumentController::class, 'index'])
        ->name('documents.index');

    Route::post('/documents', [DocumentController::class, 'store'])
        ->name('documents.store');

    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');

    Route::get('/rendez-vous', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::post('/annuaire/{user}/demande', [AppointmentController::class, 'store'])
        ->middleware('role:client')
        ->name('appointments.request');

    Route::patch('/rendez-vous/{appointment}/accepter', [AppointmentController::class, 'accept'])
        ->middleware('role:avocat')
        ->name('appointments.accept');

    Route::patch('/rendez-vous/{appointment}/refuser', [AppointmentController::class, 'reject'])
        ->middleware('role:avocat')
        ->name('appointments.reject');

    Route::get('/avocat/attente-validation', [DashboardController::class, 'lawyerPending'])
        ->name('lawyer.pending');

    Route::get('/avocat/profil', [LawyerProfileController::class, 'edit'])
        ->middleware('role:avocat')
        ->name('lawyer.profile.edit');

    Route::patch('/avocat/profil', [LawyerProfileController::class, 'update'])
        ->middleware('role:avocat')
        ->name('lawyer.profile.update');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/annuaire', [DirectoryController::class, 'index'])
    ->name('directory.index');

Route::get('/annuaire/{user}', [DirectoryController::class, 'show'])
    ->name('directory.show');

require __DIR__.'/auth.php';
