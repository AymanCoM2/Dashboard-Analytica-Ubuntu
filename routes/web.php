<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\QueryOfReportController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RoleMatchQuery;
use App\Http\Middleware\approvedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\FileGenerationController;
use App\Http\Controllers\UserController;

// =============================================
// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// adminRole
Route::get('/dash', [DashController::class, 'index'])->name('dash.index')->middleware(['verified', approvedUser::class]);

// =============================================================
Route::get('/dash/categories', [ReportCategoryController::class, 'index'])->name('categories.manage.index')->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/categories/create', [ReportCategoryController::class, 'create'])->name('categories.manage.create')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/categories/create', [ReportCategoryController::class, 'store'])->name('categories.manage.store')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/categories/update/{id}', [ReportCategoryController::class, 'update'])->name('categories.manage.update')->middleware(['verified', RoleMiddleware::class]);
Route::delete('/dash/categories/delete/{id}', [ReportCategoryController::class, 'delete'])->name('categories.manage.delete')->middleware(['verified', RoleMiddleware::class]);

// =======================End Of Category Routes , Start Of Query Routes ============
Route::get('/dash/queries', [QueryOfReportController::class, 'index'])->name('queries.manage.index')->middleware(['verified', approvedUser::class]);
Route::get('/dash/queries/create', [QueryOfReportController::class, 'create'])->name('queries.manage.create')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/queries/create', [QueryOfReportController::class, 'store'])->name('queries.manage.store')->middleware(['verified', RoleMiddleware::class]);

Route::get('/dash/queries/view/{id}', [QueryOfReportController::class, 'view'])->name('queries.manage.view')->middleware(['verified', approvedUser::class, RoleMatchQuery::class]);
// TODO define ONLY the Queries Of the Role 

Route::get('/dash/queries/edit/{id}', [QueryOfReportController::class, 'edit'])->name('queries.manage.edit')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/queries/update/{id}', [QueryOfReportController::class, 'update'])->name('queries.manage.update')->middleware(['verified', RoleMiddleware::class]);
Route::delete('/dash/queries/delete/{id}', [QueryOfReportController::class, 'delete'])->name('queries.manage.delete')->middleware(['verified', RoleMiddleware::class]);

// =====================End Of QUERIES Routes , Start Of ROLES Routes ============
Route::get('/dash/roles', [RoleController::class, 'index'])->name('roles.manage.index')->middleware(['verified', RoleMiddleware::class]);
Route::get('/dash/roles/create', [RoleController::class, 'create'])->name('roles.manage.create')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/roles/create', [RoleController::class, 'store'])->name('roles.manage.store')->middleware(['verified', RoleMiddleware::class]);
Route::get('/dash/roles/show/{id}', [RoleController::class, 'show'])->name('roles.manage.view')->middleware(['verified', RoleMiddleware::class]);
Route::get('/dash/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.manage.edit')->middleware(['verified', RoleMiddleware::class]);
Route::post('/dash/roles/update/{id}', [RoleController::class, 'update'])->name('roles.manage.update')->middleware(['verified', RoleMiddleware::class]);
Route::delete('/dash/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.manage.delete')->middleware(['verified', RoleMiddleware::class]);

// =====================End Of Roles Routes , Start Of Users Routes ============
Route::get('/dash/users', [UserController::class, 'index'])->name('users.manage.index')->middleware(['verified', RoleMiddleware::class]);
Route::get('/dash/users/edit/{id}', [UserController::class, 'edit'])->name('users.manage.edit')->middleware(['verified', RoleMiddleware::class]);
Route::get('/dash/users/show/{id}', [UserController::class, 'showUserData'])->name('users.manage.show')->middleware(['verified', RoleMiddleware::class]);

Route::post('/dash/users/update/{id}', [UserController::class, 'update'])->name('users.manage.update')->middleware(['verified', RoleMiddleware::class]);

Route::post('/data/data', [DummyController::class, 'index'])->name('vvv');
// Route::get('/data/data', [DummyController::class, 'index'])->name('vvv');

Route::get('/needapproval', [DummyController::class, 'approveFirst'])->name('need-approval')->middleware('verified'); // TODO not-approved-Yet-User


Route::post('/toggleApproval/{userId}', [UserController::class, 'toggleApproval'])->name('toggleUserApproval')->middleware(['verified', RoleMiddleware::class]);

// =========================================================
Route::get('data/generate-pdf', [FileGenerationController::class, 'generatePdf'])->name('pdf-generate');