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
            $rep = reports::where('id', '=', $request->reportId)->first();
            $entries = $rep->entries;
            $entries = $entries->sortBy('position');
            $data = [];
            if($rep !== null){
                foreach ($entries as $entry) {
                    $data[$entry->id] = [
                        'id' => $entry->id,
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
            $ent = entries::create([
                'report_id' => $request->report_id,
                'position' => $request->position,
                'duration' => $request->duration,
                'header' => $request->header,
                'description' => $request->description,
                'type' => $request->type
            ]);
            $ent->save();

            $data[$ent->id] = [
                'position' => $ent->position,
                'duration' => $ent->duration,
                'header' => $ent->header,
                'description' => $ent->description,
                'type' => $ent->type,
                'created_at' => $ent->created_at,
                'updated_at' => $ent->updated_at,
            ];

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
        
        if($request->entry_id !== null){
          if (Auth::check()) {
            $ent = entries::where('id', '=', $request->entry_id)->first();
            $ent->position = $request->position;
            $ent->duration = $request->duration;
            $ent->header = $request->header;
            $ent->description = $request->description;
            $ent->type = $request->type;

            $ent->save();

            $data[$ent->id] = [
              'position' => $ent->position,
              'duration' => $ent->duration,
              'header' => $ent->header,
              'description' => $ent->description,
              'type' => $ent->type,
              'created_at' => $ent->created_at,
              'updated_at' => $ent->updated_at,
            ];

            $response['error'] = false;
            $response['data'] = $data;
            return response()->json($response);
          }
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

            $ent = entries::where('id', '=', $request->entry_id)->first();
            $ent->delete();

            $response['error'] = false;
            $response['data'] = ['delete' => true];
            return response()->json($response);
        }

        $response['error_message'] = 'Something went wrong';
        return response()->json($response);
    }
}
