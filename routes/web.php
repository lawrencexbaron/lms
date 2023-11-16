<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\EnrollController;
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
    return redirect(route('login'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sections/getsections', [SectionController::class, 'getSections'])->name('section.getSections');


Route::middleware('auth')->group(function () {
    // Section Routes
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('section.create');
    Route::post('/sections/store', [SectionController::class, 'store'])->name('section.store');
    Route::delete('/sections/delete/{section}', [SectionController::class, 'destroy'])->name('section.delete');
    Route::get('/sections/edit/{section}', [SectionController::class, 'edit'])->name('section.edit');
    Route::put('/sections/update/{section}', [SectionController::class, 'update'])->name('section.update');
    Route::get('/sections/{section}', [SectionController::class, 'show'])->name('section.show');
    // Route::get('/sections/getsections', [SectionController::class, 'getSections'])->name('section.getSections');

    // Enroll Routes
    Route::get('/enrolled', [EnrollController::class, 'enrolled'])->name('enrolled.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
