<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::get('/dash/roles', [RoleController::class, 'index'])
    ->name('roles.manage.index')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/roles/create', [RoleController::class, 'create'])
    ->name('roles.manage.create')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/roles/create', [RoleController::class, 'store'])
    ->name('roles.manage.store')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/roles/show/{id}', [RoleController::class, 'show'])
    ->name('roles.manage.view')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/roles/edit/{id}', [RoleController::class, 'edit'])
    ->name('roles.manage.edit')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/roles/update/{id}', [RoleController::class, 'update'])
    ->name('roles.manage.update')
    ->middleware(['verified', RoleMiddleware::class]);

Route::delete('/dash/roles/destroy/{id}', [RoleController::class, 'destroy'])
    ->name('roles.manage.delete')
    ->middleware(['verified', RoleMiddleware::class]);
