<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    //

    public function index(){

    	return view('tests.login');
    }

    public function login(Request $request){
    	$user = User::where('username','=',$request->username)->first();
		if( $user !== null){
			if(Hash::check($request->password, $user->password)){
				dd('password correct');
			}
			dd('pw wrong');
		}  
		
		$user = User::create([
			'username' => $request->username,
			'password' => Hash::make($request->password),
		]);
		$user->save();
		dd('worked out');
  	}
}
