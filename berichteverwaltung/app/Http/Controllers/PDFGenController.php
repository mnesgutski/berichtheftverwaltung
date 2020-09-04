<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\reports;

class PDFGenController extends Controller
{
    //

    public function download(Request $request)
    {
        //like regular view even with compact for carrying variables

    	$report = reports::find($request->report_id);
    	$user = User::find(Auth::id());

        $pdf = PDF::loadView('pdf.report');

        return $pdf->download('report.pdf');
    }
}
