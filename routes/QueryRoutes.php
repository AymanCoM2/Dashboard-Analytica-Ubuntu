<?php

use App\Http\Controllers\QueryOfReportController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RoleMatchQuery;
use App\Http\Middleware\approvedUser;
use Illuminate\Support\Facades\Route;

Route::get('/dash/queries', [QueryOfReportController::class, 'index'])
    ->name('queries.manage.index')
    ->middleware(['verified', approvedUser::class]);

Route::get('/dash/queries/create', [QueryOfReportController::class, 'create'])
    ->name('queries.manage.create')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/queries/create', [QueryOfReportController::class, 'store'])
    ->name('queries.manage.store')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/queries/view/{id}', [QueryOfReportController::class, 'view'])
    ->name('queries.manage.view')
    ->middleware(['verified', approvedUser::class, RoleMatchQuery::class]);

Route::get('/dash/queries/edit/{id}', [QueryOfReportController::class, 'edit'])
    ->name('queries.manage.edit')
    ->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/queries/update/{id}', [QueryOfReportController::class, 'update'])
    ->name('queries.manage.update')
    ->middleware(['verified', RoleMiddleware::class]);

Route::delete('/dash/queries/delete/{id}', [QueryOfReportController::class, 'delete'])
    ->name('queries.manage.delete')
    ->middleware(['verified', RoleMiddleware::class]);
