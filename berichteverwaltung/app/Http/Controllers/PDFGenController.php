<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFGenController extends Controller
{
    //

    public function download(){
    	$pdf = PDF::loadView('pdf.report');

    	return $pdf->download('report.pdf');
    }
}
