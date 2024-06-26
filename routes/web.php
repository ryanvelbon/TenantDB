<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\TenantController;
use App\Http\Controllers\Frontend\TenantReportController;
use App\Http\Controllers\Frontend\ContractController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__.'/auth.php';

Route::group(['as' => 'frontend.', 'namespace' => null, 'middleware' => ['auth']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Properties
    Route::resource('/properties', PropertyController::class);

    // Tenants
    Route::resource('/tenants', TenantController::class);

    // Tenant Reports
    Route::get('/tenant-reports/search', [TenantReportController::class, 'searchPage'])->name('tenantReports.searchPage');
    Route::get('/tenant-reports/create', [TenantReportController::class, 'create'])->name('tenantReports.create');
    Route::post('/tenant-reports', [TenantReportController::class, 'store'])->name('tenantReports.store');
    Route::get('/tenant-reports', [TenantReportController::class, 'index'])->name('tenantReports.index');

    // Contracts
    Route::delete('/contracts/destroy', [ContractController::class, 'massDestroy'])->name('contracts.massDestroy');
    Route::put('/contracts/{contract}/restore', [ContractController::class, 'restore'])->name('contracts.restore');
    Route::resource('/contracts', ContractController::class);
});
