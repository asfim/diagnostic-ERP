<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $data = [
        'total_patients' => \App\Models\Patient::count(),
        'total_doctors' => \App\Models\Doctor::count(),
        'total_appointments' => \App\Models\Appointment::count(),
        'total_invoices' => \App\Models\Invoice::count(),
        'total_revenue' => \App\Models\Invoice::sum('paid'),
        'total_lab_orders' => \App\Models\DiagnosticOrder::count(),
        'recent_patients' => \App\Models\Patient::latest()->take(5)->get(),
        'recent_appointments' => \App\Models\Appointment::with(['patient', 'doctor'])->latest()->take(5)->get(),
    ];
    return view('admin.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
    Route::resource('tests', \App\Http\Controllers\TestController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('diagnostic-orders', \App\Http\Controllers\DiagnosticOrderController::class);
    Route::resource('consultations', \App\Http\Controllers\ConsultationController::class);
    Route::resource('test-results', \App\Http\Controllers\TestResultController::class);

    // Accounts
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');

    // Staff & Roles
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/account', [ReportController::class, 'account'])->name('account');
        Route::get('/patient', [ReportController::class, 'patient'])->name('patient');
        Route::get('/doctor', [ReportController::class, 'doctor'])->name('doctor');
        Route::get('/lab-order', [ReportController::class, 'labOrder'])->name('labOrder');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
