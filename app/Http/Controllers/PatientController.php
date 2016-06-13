<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPatientRequest;
use App\Image;
use App\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get all the data thats need to fill up the lists or CB
        $cities = DB::table('domains')->where('des_dom', 'cities')->lists('description', 'value');
        $countries = DB::table('domains')->where('des_dom', 'countries')->lists('description', 'value');
        $proffessions = DB::table('domains')->where('des_dom', 'proffession')->lists('description', 'value');
        $marital_status = DB::table('domains')->where('des_dom', 'marital_status')->lists('description', 'value');
        $languages = DB::table('domains')->where('des_dom', 'language')->lists('description', 'value');
        $adults = DB::table('domains')->where('des_dom', 'adult')->lists('description', 'value');
        $genders = DB::table('domains')->where('des_dom', 'gender')->lists('description', 'value');

        return view('webapp-layouts.patient.newPatient',
            compact([
                'cities', 'countries', 'proffessions', 'marital_status', 'languages',
                'adults', 'genders'
            ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewPatientRequest $request)
    {

        $inputs = $request->all();

        // Check if file exist
        if($file = $request->file('file')) {

            $pathFolderPhotosUpload = 'imagesUpload';

            $pathComplete = $pathFolderPhotosUpload . '/' . time() . '_' . $file->getClientOriginalName();

            $file->move($pathFolderPhotosUpload, $pathComplete);

            $image = Image::create(['path'=>$pathComplete]);

            $inputs['photo_id'] = $image->id;
        }

        $user = Auth::user();

        $inputs['user_update'] = $user->id;
        $inputs['id_patient'] = 'PA' . time();

        Patient::create($inputs);

        // After creating the patient we set the notification to the session to show the msg
        Session::flash('created_patient', 'The patient has been created');

        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allPatientsAjax(Request $request) {


        // Using Eloquent
        return Datatables::eloquent(Patient::query())->make(true);
    }

}
