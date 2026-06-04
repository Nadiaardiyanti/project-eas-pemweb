<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrdController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // BRD
    Route::post('/brd/{id}/approval-engineering',
        [BrdController::class, 'approvalEngineering'])
        ->name('brd.approvalEngineering');

    Route::post('/brd/{id}/approval-finance',
        [BrdController::class, 'approvalFinance'])
        ->name('brd.approvalFinance');

    Route::resource('brd', BrdController::class);

    // BERITA ACARA
    Route::get('/berita-acara',
        [BeritaAcaraController::class, 'index'])
        ->name('ba.index');

    Route::get('/berita-acara/create/{brdId}',
        [BeritaAcaraController::class, 'create'])
        ->name('ba.create');

    Route::post('/berita-acara/store',
        [BeritaAcaraController::class, 'store'])
        ->name('ba.store');

    Route::get('/berita-acara/{id}/dokumen',
        [BeritaAcaraController::class, 'dokumen'])
        ->name('ba.dokumen');

    Route::post('/berita-acara/{id}/approval-finance',
        [BeritaAcaraController::class, 'approvalFinance'])
        ->name('ba.approvalFinance');

    Route::delete('/berita-acara/{id}',
        [BeritaAcaraController::class, 'destroy'])
        ->name('ba.destroy');    

    Route::get('/berita-acara/{id}',
        [BeritaAcaraController::class, 'show'])
        ->name('ba.show');

    Route::put('/berita-acara/{id}',
        [BeritaAcaraController::class, 'update'])
        ->name('ba.update');    

    // INVOICE
Route::get('/invoice',
    [InvoiceController::class, 'index'])
    ->name('invoice.index');

Route::get('/invoice/create/{baId}',
    [InvoiceController::class, 'create'])
    ->name('invoice.create');

Route::post('/invoice/store',
    [InvoiceController::class, 'store'])
    ->name('invoice.store');

Route::get('/invoice/{id}/dokumen',
    [InvoiceController::class, 'dokumen'])
    ->name('invoice.dokumen');

Route::put('/invoice/{id}',
    [InvoiceController::class, 'update'])
    ->name('invoice.update');

Route::post('/invoice/{id}/lunas',
    [InvoiceController::class, 'lunas'])
    ->name('invoice.lunas');

Route::delete('/invoice/{id}',
    [InvoiceController::class, 'destroy'])
    ->name('invoice.destroy');

Route::get('/invoice/{id}',
    [InvoiceController::class, 'show'])
    ->name('invoice.show');

});

require __DIR__.'/auth.php';