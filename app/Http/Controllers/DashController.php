<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportCategory;

class DashController extends Controller
{
    public function index()
    {
        return view('dash');
    }
}
