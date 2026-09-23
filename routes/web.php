<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index']);

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

// Frontend Services
Route::get('/departments', [\App\Http\Controllers\Frontend\DepartmentController::class, 'index']);
Route::get('/departments/{slug}', [\App\Http\Controllers\Frontend\DepartmentController::class, 'show']);

Route::get('/tests', [\App\Http\Controllers\Frontend\TestController::class, 'index']);
Route::get('/tests/{id}', [\App\Http\Controllers\Frontend\TestController::class, 'show'])->whereNumber('id');

Route::get('/packages', [\App\Http\Controllers\Frontend\PackageController::class, 'index']);
Route::get('/packages/{id}', [\App\Http\Controllers\Frontend\PackageController::class, 'show']);

Route::get('/doctors', [\App\Http\Controllers\Frontend\DoctorController::class, 'index']);
Route::get('/doctors/{id}', [\App\Http\Controllers\Frontend\DoctorController::class, 'show'])->whereNumber('id');

Route::get('/appointment', [\App\Http\Controllers\Frontend\AppointmentController::class, 'index'])->name('frontend.appointment');
Route::post('/appointment', [\App\Http\Controllers\Frontend\AppointmentController::class, 'store'])->name('frontend.appointment.store');
Route::get('/appointment/confirmation/{id}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'confirmation'])->name('frontend.appointment.confirmation');

// API routes for appointment form
Route::get('/api/doctors-by-department', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getDoctorsByDepartment']);
Route::get('/api/tests-by-department', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getTestsByDepartment']);
Route::get('/api/doctor-slots', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getAvailableSlots']);

Route::get('/home-collection', function () {
    return view('frontend.home-collection');
});

Route::get('/pricing', function () {
    return view('frontend.pricing');
});

Route::get('/reports', [\App\Http\Controllers\Frontend\ReportController::class, 'index']);
Route::post('/reports/search', [\App\Http\Controllers\Frontend\ReportController::class, 'search'])->name('frontend.reports.search');
Route::get('/reports/search', function () {
    return redirect('/reports');
});
Route::get('/reports/{id}/download', [\App\Http\Controllers\Frontend\ReportController::class, 'download'])->name('frontend.reports.download');

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/faq', function () {
    return view('frontend.faq');
});

Route::get('/branches', function () {
    return view('frontend.branches');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('admin-doctors', \App\Http\Controllers\DoctorController::class)->names('doctors')->parameters(['admin-doctors' => 'doctor']);
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
    Route::patch('appointments/{appointment}/status', [\App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::resource('admin-tests', \App\Http\Controllers\TestController::class)->names('tests')->parameters(['admin-tests' => 'test']);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('diagnostic-orders', \App\Http\Controllers\DiagnosticOrderController::class);
    Route::patch('diagnostic-orders/{order}/status', [\App\Http\Controllers\DiagnosticOrderController::class, 'updateStatus'])->name('diagnostic-orders.updateStatus');

    // Consultations & Prescriptions
    Route::resource('consultations', \App\Http\Controllers\ConsultationController::class);
    Route::patch('consultations/{visit}/status', [\App\Http\Controllers\ConsultationController::class, 'updateStatus'])->name('consultations.updateStatus');
    Route::get('visits/{visit}/prescription', [\App\Http\Controllers\PrescriptionController::class, 'form'])->name('prescriptions.form');
    Route::post('visits/{visit}/prescription', [\App\Http\Controllers\PrescriptionController::class, 'save'])->name('prescriptions.save');

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

    // Settings
    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

    // Frontend CMS
    Route::get('/cms', [\App\Http\Controllers\FrontendCMSController::class, 'index'])->name('cms.index');
    Route::put('/cms/hero', [\App\Http\Controllers\FrontendCMSController::class, 'updateHero'])->name('cms.hero.update');
    Route::put('/cms/stats', [\App\Http\Controllers\FrontendCMSController::class, 'updateStats'])->name('cms.stats.update');
    Route::put('/cms/quick-actions', [\App\Http\Controllers\FrontendCMSController::class, 'updateQuickActions'])->name('cms.quick_actions.update');
    Route::put('/cms/about', [\App\Http\Controllers\FrontendCMSController::class, 'updateAbout'])->name('cms.about.update');
});

require __DIR__.'/auth.php';
