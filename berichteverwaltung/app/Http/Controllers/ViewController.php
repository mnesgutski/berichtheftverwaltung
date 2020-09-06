<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ViewController extends Controller
{
    //

    public function index()
    {
        return view('app');
    }

    public function redirect(){
        return redirect()->route('login');
    }
}
