<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FileGenerationController extends Controller
{
    public function generatePdf(Request $request)
    {
        // Get the Data From the ajax Request  , 
        // Generate a File From this File and Dump the pdf  ; 
        if ($request->ajax()) {
            $received_query = $request->que;
            $pdf  = PDF::loadHTML('<h1>Test</h1>');
            return $pdf->download('invoice.pdf');
        }
    }
}