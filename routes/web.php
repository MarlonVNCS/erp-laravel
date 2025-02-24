<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\XMLController;


Route::middleware('auth')
    ->group(function(){
        Route::get('/', function () {
            return view('main');
        });

        Route::get('/nf/insert', function () {
            return view('nf.insert');
        })->name('insert');

        Route::get('/insert', function () {
            return view('nf.insert');
        })->name('insert.xml');
        
        Route::post('/upload', [XMLController::class, 'store'])->name('upload.xml');
        Route::get('/data', [XMLController::class, 'show'])->name('data.xml');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
