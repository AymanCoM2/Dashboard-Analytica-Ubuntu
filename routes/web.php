<?php

use App\Http\Controllers\DashController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\approvedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\FileGenerationController;
use App\Http\Controllers\UserController;


Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// adminRole
Route::get('/dash', [DashController::class, 'index'])->name('dash.index')->middleware(['verified', approvedUser::class]);

Route::group([], __DIR__ . '/CategoryRoutes.php');
Route::group([], __DIR__ . '/QueryRoutes.php');
Route::group([], __DIR__ . '/RoleRoutes.php');
Route::group([], __DIR__ . '/UserRoutes.php');
Route::group([], __DIR__ . '/SearchRoutes.php');

Route::post('/data/data', [DummyController::class, 'index'])
    ->name('vvv');

Route::get('/needapproval', [DummyController::class, 'approveFirst'])
    ->name('need-approval')
    ->middleware('verified'); // TODO not-approved-Yet-User

Route::post('/toggleApproval/{userId}', [UserController::class, 'toggleApproval'])
    ->name('toggleUserApproval')
    ->middleware(['verified', RoleMiddleware::class]);

Route::get('data/generate-pdf', [FileGenerationController::class, 'generatePdf'])
    ->name('pdf-generate');


