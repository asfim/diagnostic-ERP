<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
    Route::resource('tests', \App\Http\Controllers\TestController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('diagnostic-orders', \App\Http\Controllers\DiagnosticOrderController::class);
    Route::resource('consultations', \App\Http\Controllers\ConsultationController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
