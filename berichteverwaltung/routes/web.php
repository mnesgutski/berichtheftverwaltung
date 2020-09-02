<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ViewController@index')->name('home');
Route::get('/login','ViewController@index')->name('login');


Route::post('/login','LoginController@login')->name('login.post')


/**
*	Test Routes
**/
Route::get('/test','TestController@index');
Route::get('/testapi','TestController@loginTest');

Route::post('/test/login', 'TestController@login')->name('test.login');