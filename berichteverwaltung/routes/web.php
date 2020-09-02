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

Route::get('/', 'ViewController@index')->name('home');
//Route::get('/login', 'ViewController@index')->name('login')->middleware('guest');
Route::get('/login', 'ViewController@index')->name('login');

Route::post('/login', 'LoginController@login')->name('login.post');


/**
 * Route Group for all the routes that require the user to be authorized
 */
Route::group(['middleware' => ['auth']], function () {
    /**
     * ReportBook Routes
     */
    Route::get('/reportBooks', 'ViewController@index')->name('reportBooks.index');
    Route::post('/reportBooks/get', 'ReportBookController@get')->name('reportBooks.get');
    Route::post('/reportBooks/create', 'ReportBookController@create')->name('reportBooks.create');
    Route::post('/reportBooks/update', 'ReportBookController@update')->name('reportBooks.update');
    Route::post('/reportBooks/delete', 'ReportBookController@delete')->name('reportBooks.delete');

    /**
     * Report Routes
     */
    Route::get('/reports', 'ViewController@index')->name('reports.index');
    Route::post('/reports/get', 'ReportController@get')->name('reports.get');
    Route::post('/reports/create', 'ReportController@create')->name('reports.create');
    Route::post('/reports/update', 'ReportController@update')->name('reports.update');
    Route::post('/reports/delete', 'ReportController@delete')->name('reports.delete');

    /**
     * Entry Routes
     */
    Route::get('/entries', 'ViewController@index')->name('entries.index');
    Route::post('/entries/get', 'EntryController@get')->name('entries.get');
    Route::post('/entries/create', 'EntryController@create')->name('entries.create');
    Route::post('/entries/update', 'EntryController@update')->name('entries.update');
    Route::post('/entries/delete', 'EntryController@delete')->name('entries.delete');
});

/**
 *    Test Routes
 **/
Route::get('/test', 'TestController@index');
Route::get('/testapi', 'TestController@loginTest');
Route::get('/test/reportBooks', 'TestController@reportBooks')->name('test.reportBooks');

Route::get('/test/dumps', 'TestController@dumpStuff')->name('test.dump');

Route::post('/test/login', 'TestController@login')->name('test.login');
Route::post('/test/reportBooks/create', 'TestController@createReportBook')->name('test.create.reportBook');