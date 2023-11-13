<?php

use App\Http\Controllers\DashController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\approvedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\FileGenerationController;
use App\Http\Controllers\UserController;


Route::get('/dashboard/search', function () {
    // -return the View For it-
    return view('pages.searching');
})->name('search-get');


Route::post('/dashboard/search', function () {
    // return the Same View With the Data Reveived from the Query after checking it
    
})->name('search-post');
