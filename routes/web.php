<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormTemplateController;

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])
        ->name('user.dashboard');
});

 Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    Route::get('/admin/reports', [ReportController::class, 'adminIndex'])
        ->name('admin.reports.index');

    Route::get('/admin/reports/{submission}', [ReportController::class, 'adminShow'])
        ->name('admin.reports.show');

    Route::post('/admin/reports/{submission}/start-review', [ReportController::class, 'startReview'])
    ->name('admin.reports.startReview');

    Route::post('/admin/reports/{submission}/approve', [ReportController::class, 'approve'])
    ->name('admin.reports.approve');
    
    Route::post('/admin/reports/{submission}/reject', [ReportController::class, 'reject'])
    ->name('admin.reports.reject');

    Route::get('/admin/templates', [FormTemplateController::class, 'index'])
    ->name('admin.templates.index');

    Route::get('/admin/templates/create', [FormTemplateController::class, 'create'])
    ->name('admin.templates.create');

    Route::post('/admin/templates', [FormTemplateController::class, 'store'])
    ->name('admin.templates.store');

    Route::get('/admin/templates/{formTemplate}/edit', [FormTemplateController::class, 'edit'])
    ->name('admin.templates.edit');
    
    Route::put('/admin/templates/{formTemplate}', [FormTemplateController::class, 'update'])
    ->name('admin.templates.update');

    Route::get('/admin/templates/{formTemplate}', [FormTemplateController::class, 'show'])
    ->name('admin.templates.show');

    Route::delete('/admin/templates/{formTemplate}', [FormTemplateController::class, 'destroy'])
    ->name('admin.templates.destroy');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/superadmin/dashboard', function () {
        return view('dashboard.superadmin');
    })->name('superadmin.dashboard');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/amo/forms', [FormController::class, 'index'])
        ->name('amo.forms.index');

    Route::get('/amo/forms/{form}', [FormController::class, 'show'])
        ->name('amo.forms.show');

    Route::post('/amo/forms/{form}', [FormController::class, 'store'])
        ->name('amo.forms.store');

    Route::get('/amo/reports', [ReportController::class, 'index'])
    ->name('amo.reports.index');

    Route::get('/amo/reports/template/{formTemplate}', [ReportController::class, 'folder'])
    ->name('amo.reports.folder');

    Route::get('/amo/reports/{submission}', [ReportController::class, 'show'])
    ->name('amo.reports.show');

    Route::post('/amo/reports/{submission}/submit', [ReportController::class, 'submit'])
    ->name('amo.reports.submit');

    Route::get('/amo/reports/{submission}/pdf', [ReportController::class, 'pdf'])
    ->name('amo.reports.pdf');

    Route::get('/amo/reports/{submission}/edit', [ReportController::class, 'edit'])
    ->name('amo.reports.edit');
    
    Route::put('/amo/reports/{submission}', [ReportController::class, 'update'])
    ->name('amo.reports.update');
});