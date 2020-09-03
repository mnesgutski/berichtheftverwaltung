<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\report_books;
use Illuminate\Support\Facades\Validator;

class ReportBookController extends Controller
{

    //@TODO: MAIK fix validation and make proper errors and catch exceptions
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

	/**
	* creates reportbook from request data and returns in json format
	**/
    public function create(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];

        /**$validator = Validator::make($request->all(), [
            'apprenticeship_name' => 'required',
            'begin_date' => 'required'
        ]);

        if($validator->fails()){
            $response['error_message'] = 'apprenticeship name and begin_date are required to work';
            return response()->json($response);
        }**/

        if(Auth::check()){
        	$reportBook = report_books::create([
        		'owner' => Auth::id(),
        		'apprenticeship_name' => ($request->apprenticeship_name !== null || $request->apprenticeship_name !== "") ? $request->apprenticeship_name :'',
        		'begin_date' => ($request->begin_date !== null || $request->begin_date !== "") ? $request->begin_date :'',
        		'end_date' => ($request->end_date !== null || $request->end_date !== "") ? $request->end_date :'',
        	]);

        	$reportBook->save();

        	$data[$reportBook->id] = [
                    'owner' => $reportBook->owner,
                    'name' => $reportBook->apprenticeship_name,
                    'begin_date' => $reportBook->begin_date,
                    'end_date' => $reportBook->end_date,
                    'created_at' => $reportBook->created_at,
                    'updated_at' => $reportBook->updated_at
                ];
            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);

        }

        $response['error_message'] = 'Authorization needed';
        return response()->json($response);
    }

    public function update(Request $request){
    	$response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if(Auth::check()){
        	$rBook = report_books::where('id', '=', $request->reportBookId)
	        	->where('owner','=', Auth::id())
	        	->first();
	        $rbook->apprenticeship_name = ($request->apprenticeship_name !== null || $request->apprenticeship_name !== "") ? $request->apprenticeship_name : $rbook->apprenticeship_name;
	        $rbook->begin_date = ($request->begin_date !== null || $request->begin_date !== "") ? $request->begin_date : $rbook->begin_date;
	        $rbook->end_date = ($request->end_date !== null || $request->end_date !== "") ? $request->end_date : $rbook->end_date;

            $rBook->save();

	        $data[$rBook->id] = [
                    'owner' => $rBook->owner,
                    'name' => $rBook->apprenticeship_name,
                    'begin_date' => $rBook->begin_date,
                    'end_date' => $rBook->end_date,
                    'created_at' => $rBook->created_at,
                    'updated_at' => $rBook->updated_at
                ];
            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }

    public function delete(){
    	$response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if(Auth::check()){
			$rBook = report_books::where('id', '=', $request->reportBookId)
				->where('owner','=', Auth::id())
				->first();
			$rbook->delete();
			$response['data']['delete'] = true;
			$response['error'] = false;
			return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }
}
