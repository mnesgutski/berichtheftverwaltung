<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TestController extends Controller
{
    //

    public function index(){
    	$users = User::where('username','=','maik.nesgutski')->first();

    	return view('tests',['users' => $users]);
    }

    public function loginTest(){
  
  	}
}
