<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'handleLogin'])->name('login.post');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'handleRegister'])->name('register.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'handleLogout'])->name('logout.post');
});

Route::group(['middleware' => \App\Http\Middleware\AdminMiddleware::class], function () {
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
});
