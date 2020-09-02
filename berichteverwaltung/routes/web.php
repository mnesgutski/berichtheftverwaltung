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

//@Todo:Maik authentication middleware to only allow guests to login and require auth users for further actions
// proper route grouping

Route::get('/','ViewController@index')->name('home');
Route::get('/login','ViewController@index')->name('login');
Route::get('/reportBooks', 'ViewController@index')->name('reportBooks');

Route::post('/login','LoginController@login')->name('login.post');


/**
*	Test Routes
**/
Route::get('/test','TestController@index');
Route::get('/testapi','TestController@loginTest');
Route::get('/test/reportBooks', 'TestController@reportBooks')->name('test.reportBooks');

Route::get('/test/dumps','TestController@dumpStuff')->name('test.dump');

Route::post('/test/login', 'TestController@login')->name('test.login');
Route::post('/test/reportBooks','TestController@createReportBook')->name('test.create.reportBook');