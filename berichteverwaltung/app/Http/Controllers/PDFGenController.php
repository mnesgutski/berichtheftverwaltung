<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\reports;
use App\User;

class PDFGenController extends Controller
{
    //

    public function download(Request $request)
    {
        //like regular view even with compact for carrying variables

    	//$report = reports::find($request->report_id);
    	$report = reports::find(1);
    	//$user = User::find(Auth::id());
    	$user = User::find(1);
    	dump($report->entries);
    	$data = [];
    	foreach($report->entries as $entry){
    		$data['type'] = [
    			$entry->type = [
    				'duration' => $entry->duration,
    				'header' => $entry->header,
    				'description' => $entry->description,
    			]
    		];
    	}
    	$report = $data;
    	dd($report);

        $pdf = PDF::loadView('pdf.report', compact('user','report'));

        return $pdf->download('report.pdf');
    }
}
