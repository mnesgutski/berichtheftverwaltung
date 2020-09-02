<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    

    public function login(Request $request)
    {
    	$user = User::where('username','=',$request->username)->first();
    	$responses = [
    		'error' => true,
    		'error_message' => '',
    		'data' => []
    		];
		if( $user !== null){
			if(Hash::check($request->password, $user->password)){
				dd('password correct');
				$user->auth();
			}
			dd('pw wrong');
		}  
		
		$user = User::create([
			'username' => $request->username,
			'password' => Hash::make($request->password),
		]);
		$user->save();
		$user->auth();
		dd('worked out');
  	}
    
}
