<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\report_books;
use Illuminate\Support\Facades\Validator;

class ReportBookController extends Controller
{
    public function get(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {
            $reportBooks = auth()->user()->reportBooks;
            $data = [];
            foreach($reportBooks as $reportBook) {
                $data[$reportBook->id] = [
                    'owner' => $reportBook->owner,
                    'name' => $reportBook->apprenticeship_name,
                    'begin_date' => $reportBook->begin_date,
                    'end_date' => $reportBook->end_date,
                    'created_at' => $reportBook->created_at,
                    'updated_at' => $reportBook->updated_at
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

        $validator = Validator::make($request->all(), [
            'apprenticeship_name' => 'required',
            'begin_date' => 'required'
        ]);

        if($validator->fails()){
            $response['error_message'] = 'apprenticeship name and begin_date are required to work';
            return response()->json($response);
        }

        if(Auth::check()){
        	$reportBook = report_books::create([
        		'owner' => Auth::id(),
        		'apprenticeship_name' => () ? :''
        	]);
        }

        $response['error_message'] = 'Authorization needed';
        return response()->json($response);
    }

    public function update(){
        if(Auth::check()){

        }
    }

    public function delete(){
        if(Auth::check()){

        }
    }
}
