<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\report_books;

class ReportBookController extends Controller
{
    public function get(Request $request)
    {
        $responses = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {
            $reportBooks = auth()->user()->reportBooks;
            $data = [];
            foreach($reportBooks as $reportBook) {

            }

            return response()->json($responses);
        }
    }

    public function create(Request $request)
    {
        if(Auth::check()){

        }

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
