<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\reports;
use App\entries;

class EntryController extends Controller
{
    //
    public function get(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];

        if (Auth::check()) {
            $rep = reports::where('id','=',$request->reportId)->first();
            $data = [];
            foreach($rep->entries as $entry){
                $data[$entry->id] = [
                    'position' => $entry->position,
                    'duration' => $entry->duration,
                    'header' => $entry->header,
                    'description' => $entry->description,
                    'type' => $entry->type,
                    'created_at' => $entry->created_at,
                    'updated_at' => $entry->updated_at,
                ];
            }

            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
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

         $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];

        if (Auth::check()) {
            
            
            
            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];

        if (Auth::check()) {

            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }
}
