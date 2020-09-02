<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
	* Logs user in if User exists. Creates User if User doesnt exist
	**/
    public function login(Request $request)
    {
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
			if(Hash::check($request->password, $user->password)){
				$user->auth();
				$response['error'] = false;
				$response['data']['login'] = true;
				$response['data']['pw'] = true;
				$response['data']['username'] = $user->username;
				return response()->json($response);
			}
			$response['error'] = false;
			return response()->json($response);
		}  
		
		$user = User::create([
			'username' => $request->username,
			'password' => Hash::make($request->password),
		]);

		$user->save();
		$user->auth();

		$response['error'] = false;
		$response['data']['login'] = true;
		$response['data']['pw'] = true;
		$response['data']['username'] = $user->username;
		$response['data']['registered'] = true;
		return response()->json($response);
  	}
    
}
