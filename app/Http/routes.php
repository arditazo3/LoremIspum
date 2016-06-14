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
    Route::resource('admin/patient', 'PatientController');

    /**
     * ClientController CRUD operations
     */
     Route::resource('admin/calendar', 'CalendarController');

    /**
     * -------------------------------------------
     * HERE ARE ALL ROUTE REQUEST MADE WITH AJAX -
     * -------------------------------------------
     */

    /*
     * GET ALL PATIENTS, AJAX REQUEST
     */
    Route::get('allPatientsAjax', [
        'uses' => 'PatientController@allPatientsAjax',
        'as'   => 'allPatientsAjax'
    ]);

    Route::get('/calendarAjax', function () {
        $events = DB::table('events')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
        foreach($events as $event)
        {

            $event->nameModal = $event->name;
            $event->titleModal = $event->title;

            $event->title = $event->title . ' - ' .$event->name;
            // manage the modification through AJAX
            // $event->url = url('#');

        }
        return $events;
    });


    Route::post('api/updateEventAjax', [
        'uses' => 'CalendarController@updateEventAjax',
        'as'   => 'api/updateEventAjax'
    ]);

    Route::post('api/deleteEventAjax', [
        'uses' => 'CalendarController@deleteEventAjax',
        'as'   => 'api/deleteEventAjax'
    ]);

    Route::post('api/createEventAjax', [
        'uses' => 'CalendarController@createEventAjax',
        'as'   => 'api/createEventAjax'
    ]);

});

