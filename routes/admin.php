<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;

Route::group(['as' => 'admin.', 'namespace' => null, 'middleware' => []], function () {

    // Permissions
    Route::delete('permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionController::class);

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});