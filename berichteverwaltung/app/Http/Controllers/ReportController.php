<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report_books;
use App\reports;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function get(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {
            $rBook = report_books::where('id','=',$request->reportBookId)->first();
            $reports = $rBook->reports;
            $data = [];
            foreach($reports as $rep) {
                $data[$rep->id] = [
                    'type' => $rep->type,
                    'position' => $rep->postion,
                    'begin_date' => $rep->begin_date,
                    'end_date' => $rep->end_date,
                    'department' => $rep->department,
                    'company' => $rep->company,
                    'hours_targeted' => $rep->hours_targeted,
                    'created_at' => $rep->created_at,
                    'updated_at' => $rep->updated_at,
                ];
            }
            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }
        
        $response['error_message'] = 'Authentication needed';
        return response()->json($response);
    }

    public function create(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {
            
        }

    }

    public function update()
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {

        }
    }

    public function delete()
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {

        }
    }
}
