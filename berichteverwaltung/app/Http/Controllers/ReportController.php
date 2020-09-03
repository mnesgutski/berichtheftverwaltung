<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function get()
    {
        $response = [
            'error' => true,
            'error_message' => '',
            'data' => []
        ];
        if (Auth::check()) {
            $reports = 
        }
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
