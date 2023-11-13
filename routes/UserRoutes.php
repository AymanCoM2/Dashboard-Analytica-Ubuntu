<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/dash/users', [UserController::class, 'index'])
    ->name('users.manage.index')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/users/edit/{id}', [UserController::class, 'edit'])
    ->name('users.manage.edit')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/users/show/{id}', [UserController::class, 'showUserData'])
    ->name('users.manage.show')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/users/update/{id}', [UserController::class, 'update'])
    ->name('users.manage.update')
    ->middleware(['verified', RoleMiddleware::class]);
