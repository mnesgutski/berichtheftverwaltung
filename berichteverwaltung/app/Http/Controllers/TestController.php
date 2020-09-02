<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\report_books;

class TestController extends Controller
{
    //

    public function index(){

    	return view('tests.login');
    }

    public function login(Request $request){

    	$credentials = ['username' => $request->username, 'password' => $request->password];
    	$user = User::where('username','=',$request->username)->first();
    	$responses = [
    		'error' => true,
    		'error_message' => '',
    		'data' => [
    			'login' => false,
    			'pw' => false,
    			'username' => '',
    			'registered' => false,
    		]
    		];
		if( $user !== null){
			if(Auth::attempt($credentials)){
				
				$response['error'] = false;
				$response['data']['login'] = true;
				$response['data']['pw'] = true;
				$response['data']['username'] = $user->username;

				return redirect()->route('test.reportBooks');
			}
			$response['error'] = false;
			return response()->json($response);
		}  
		
		$user = User::create([
			'username' => $request->username,
			'password' => Hash::make($request->password),
		]);

		$user->save();
		Auth::attempt($credentials);

		$response['error'] = false;
		$response['data']['login'] = true;
		$response['data']['pw'] = true;
		$response['data']['username'] = $user->username;
		$response['data']['registered'] = true;

		return redirect()->route('test.reportBooks');
  	}

  	public function reportBooks(){
  		return view('tests.reportBooks');
  	}

  	public function createReportBook(){
  		if(Auth::check()){
  			$UserId = Auth::id();
  			$book = report_books::create([
  				'owner' => $UserId
  			]);
  			$book->save();
  			return response()->json(['worked' =>true]);
  		}
  		return response()->json(['worked' =>false]);
  	}
}
