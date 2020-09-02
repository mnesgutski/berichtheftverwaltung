<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\report_books;

class ReportBookController extends Controller
{
    public function getReportBooks(Request $request){
    	$responses = [
    		'error' => true,
    		'error_message' => '',
    		'data' => []
    	];
    	if(Auth::check()){
    		$reportBooks = auth()->user()->reportBooks;
    		$data = [];
    		foreach($reportBooks as $reportBook){

    		}

    		return repsonse()->json($responses);
    	}
    }

    public function createReportBook(Request $request)
    {

    }
}
