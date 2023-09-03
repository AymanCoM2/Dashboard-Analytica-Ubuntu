<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});