<?php

use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\TenantReportController;

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

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Frontend/Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Properties
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

    // Tenant Reports
    Route::get('/tenant-reports/search', [TenantReportController::class, 'searchPage'])->name('tenantReports.searchPage');
    Route::get('/tenant-reports/create', [TenantReportController::class, 'create'])->name('tenantReports.create');
    Route::post('/tenant-reports', [TenantReportController::class, 'store'])->name('tenantReports.store');
    Route::get('/tenant-reports', [TenantReportController::class, 'index'])->name('tenantReports.index');
});
