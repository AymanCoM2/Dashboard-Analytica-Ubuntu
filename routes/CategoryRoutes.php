<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportCategoryController;

Route::get('/dash/categories', [ReportCategoryController::class, 'index'])
    ->name('categories.manage.index')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/categories/create', [ReportCategoryController::class, 'create'])
    ->name('categories.manage.create')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/categories/create', [ReportCategoryController::class, 'store'])
    ->name('categories.manage.store')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/categories/update/{id}', [ReportCategoryController::class, 'update'])
    ->name('categories.manage.update')
    ->middleware(['verified', RoleMiddleware::class]);

Route::delete('/dash/categories/delete/{id}', [ReportCategoryController::class, 'delete'])
    ->name('categories.manage.delete')
    ->middleware(['verified', RoleMiddleware::class]);
