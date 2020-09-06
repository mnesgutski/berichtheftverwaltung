<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\reports;
use App\User;
use Illuminate\Support\Facades\Auth;

class PDFGenController extends Controller
{
    //

    public function download(Request $request)
    {
        //like regular view even with compact for carrying variables
        // comment the find(1) lines when done testing to use proper reports and entries
        $report = reports::find($request->id);
//    	$report = reports::find(1);
        $user = User::find(Auth::id());
//    	$user = User::find(1);
        $data = [];
        $from = $report->begin_date;
        $to = $report->end_date;

        $pos = ($report->position !== null) ? $report->position : ' ';
        foreach ($report->entries as $entry) {
            if ($entry->type === 'school') {
                $data['Schule'][$entry->id] = [
                    'duration' => $entry->duration,
                    'header' => $entry->header,
                    'description' => $entry->description,
                ];
            } else {
                $data['Betrieb'][$entry->id] = [
                    'duration' => $entry->duration,
                    'header' => $entry->header,
                    'description' => $entry->description,
                ];
            }

        }
        $report = $data;
        $pdf = PDF::loadView('pdf.report', compact('user', 'report', 'pos', 'from', 'to'));

        return $pdf->download('report.pdf');
    }
}
