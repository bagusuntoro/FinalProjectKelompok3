<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadview('report',[
            // database
        ]);
        return $pdf->stream();
    }
}
