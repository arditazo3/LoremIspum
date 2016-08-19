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
     * Patient Panel
     */
    Route::resource('admin/patient', 'PatientController');

    /**
     * ClientController CRUD operations
     */
     Route::resource('admin/calendar', 'CalendarController');

    /**
     * My Account
     * - My Profile
     * - Contacts
     * - Mailbox
     */
    Route::get('admin/account/profile', [ 'uses' => 'UserController@showProfile', 'as'   => 'admin.user.profile' ]);
    Route::post('admin/account/profile', [ 'uses' => 'UserController@updateProfile', 'as'   => 'admin.user.updateProfile' ]);
    Route::get('admin/account/contacts', [ 'uses' => 'UserController@showContacts', 'as'   => 'admin.user.contacts' ]);
    Route::get('admin/account/mailbox', [ 'uses' => 'UserController@showMailbox', 'as'   => 'admin.user.mailbox' ]);

    /**
     * -------------------------------------------
     * HERE ARE ALL ROUTE REQUEST MADE WITH AJAX -
     * -------------------------------------------
     */


    /**
     * PATIENT
     */
    Route::get('api/allPatientsAjax', ['uses' => 'PatientController@allPatientsAjax', 'as'   => 'api/allPatientsAjax' ]);
    Route::post('api/deletePatientAjax', ['uses' => 'PatientController@deletePatientAjax', 'as'   => 'api/deletePatientAjax' ]);
	Route::post('api/createUpdatePatientAjax', ['uses' => 'PatientController@createUpdatePatientAjax', 'as'   => 'api/createUpdatePatientAjax' ]);
	Route::post('api/getInfoControlPatient', ['uses' => 'PatientController@getInfoControlPatient', 'as'   => 'api/getInfoControlPatient' ]);
    /**
     * Cure Modal (PATIENT)
     */
    Route::post('api/getSelectedCure', ['uses' => 'CureController@getSelectedCure', 'as'   => 'api/getSelectedCure' ]);
    Route::post('api/saveUpdateCureAjax', ['uses' => 'CureController@saveUpdateCureAjax', 'as'   => 'api/saveUpdateCureAjax' ]);
    Route::post('api/deleteCureAjax', ['uses' => 'CureController@deleteCureAjax', 'as'   => 'api/deleteCureAjax' ]);
    /**
     * Teeth Chart Modal (PATIENT)
     */
    Route::get('api/getListCuresByPatient', ['uses' => 'TeethChartController@getListCuresByPatient', 'as'   => 'api/getListCuresByPatient' ]);
    
    /**
    * USER
    */
    Route::post('api/getPathProfilePicAjax', ['uses' => 'UserController@getPathProfilePicAjax', 'as'   => 'api/getPathProfilePicAjax' ]);

    /**
     * CALENDAR
     */
    Route::get('api/allEventsAjax', ['uses' => 'CalendarController@allEventsAjax', 'as'   => 'api/allEventsAjax' ]);

    Route::post('api/updateEventAjax', ['uses' => 'CalendarController@updateEventAjax', 'as'   => 'api/updateEventAjax' ]);

    Route::post('api/deleteEventAjax', ['uses' => 'CalendarController@deleteEventAjax', 'as'   => 'api/deleteEventAjax' ]);

    Route::post('api/createEventAjax', ['uses' => 'CalendarController@createEventAjax', 'as'   => 'api/createEventAjax' ]);
    
});

