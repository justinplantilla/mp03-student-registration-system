<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Student Registration System
|--------------------------------------------------------------------------
*/

// Home page routes directly to the Student Registration Form
Route::get('/', function () {
    return redirect()->route('students.create');
})->name('home');

// Alias for direct registration URL
Route::get('/register', [StudentController::class, 'create'])->name('register');

// Student Registration and Management Routes
Route::prefix('students')->name('students.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/', [StudentController::class, 'store'])->name('store');
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');
});
