<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'middleware' => []], function () {

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});