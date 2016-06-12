<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


/**
 * With middleware we can manage the user on login, and direct them depending by attribute (role, status ecc)
 * Or access the object doing Auth::user
 */
Route::group(['middleware'=>'admin'], function () {

    /*
     * ROOT URL Admin
     */
    Route::get('/admin', function () {

        return view('webapp-layouts.dashboard.dashboard');
    });

    /**
     * ClientController CRUD operations
     */
    Route::resource('admin/client', 'ClientController');

});

