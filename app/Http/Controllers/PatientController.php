<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Http\Requests\NewPatientRequest;
use App\Image;
use App\JSTreeNode;
use App\Option;
use App\Patient;
use Carbon\Carbon;
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
        // Get all the data thats need to fill up the lists or CB
        $cities = DB::table('domains')->where('des_dom', 'cities')->lists('description', 'value');
        $countries = DB::table('domains')->where('des_dom', 'countries')->lists('description', 'value');
        $proffessions = DB::table('domains')->where('des_dom', 'proffession')->lists('description', 'value');
        $marital_status = DB::table('domains')->where('des_dom', 'marital_status')->lists('description', 'value');
        $languages = DB::table('domains')->where('des_dom', 'language')->lists('description', 'value');
        $adults = DB::table('domains')->where('des_dom', 'adult')->lists('description', 'value');
        $genders = DB::table('domains')->where('des_dom', 'gender')->lists('description', 'value');
        $patient = new Patient();
        $website = Option::findOrFail(1)->value;

        /**
         * The list of variables used at Cure Modal
         */
        $listCures = DB::table('domains')
                        ->where('des_dom', 'curesAndCategories')
                        ->lists('value');

        $typeCure = Domain::where('des_dom', 'typeCure')->get();

        $statusCure = Domain::where('des_dom', 'statusCure')->get();

        $listUsers = DB::table('users')->where('is_active', 1)->lists('last_name', 'id');

        return view('webapp-layouts.patient.patient_data',
            compact([
                'cities', 'countries', 'proffessions', 'marital_status', 'languages',
                'adults', 'genders', 'patient', 'website', 'listCures', 'typeCure', 'statusCure',
                'listUsers'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function patientData() {
        $this->create();
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

    /**
     * Retrieve in format to fill up the datatables.js
     */
    public function allPatientsAjax(Request $request) {

        return Datatables::eloquent(Patient::query())->make(true);
    }
    
	public function createUpdatePatientAjax(NewPatientRequest $request) {

        $isNew = false;
		$inputs = $request->all();
		
		$patient = new Patient();
		
		/**
		* Check if has ID or not to update/create patient
		* save() method will create or update base on ID
		*/
		if($inputs['id_patient'] == '') {
            $isNew = true;
			$patient->id_patient = 	'PA' . time();
		} else {
			$patient = Patient::findOrFail($inputs['id_patient']);
		}

        // Check if file exist
        if($file = $request->file('file')) {

            $pathFolderPhotosUpload = 'imagesUpload';

            $pathComplete = $pathFolderPhotosUpload . '/' . time() . '_' . $file->getClientOriginalName();

            $file->move($pathFolderPhotosUpload, $pathComplete);

            $image = Image::create(['path'=>$pathComplete]);

            // 2 variables to get information about image profile
            $inputs['image_path'] = $pathComplete;
            $inputs['image_id'] =   $image->id;

            $patient->image_path = $inputs['image_path'];
            $patient->image_id =   $inputs['image_id'];
        }
        
		$patient->first_name =      $inputs['first_name'];
		$patient->last_name =       $inputs['last_name'];
		$patient->address =         $inputs['address'];
		$patient->email =           $inputs['email'];
		$patient->nation =          $inputs['nation'];
		$patient->city =            $inputs['city'];
		$patient->adult_child =     $inputs['adult_child'];
		$patient->sex =             $inputs['sex'];
		$patient->zip_code =        $inputs['zip_code'];
		$patient->tax_code =        $inputs['first_name'];
		$patient->date_birth =      $inputs['date_birth'];
		$patient->proffession =     $inputs['proffession'];
		$patient->marital_status =  $inputs['marital_status'];
		$patient->birth_place =     $inputs['birth_place'];
		$patient->language =        $inputs['language'];
		$patient->personal_phone =  $inputs['personal_phone'];
		$patient->office_phone =    $inputs['office_phone'];

        $patient->note1 =           $inputs['note1'];
        $patient->note2 =           $inputs['note2'];
        $patient->note3 =           $inputs['note3'];
        $patient->note4 =           $inputs['note4'];

        $user = Auth::user();
        $inputs['user_update'] = $user->id;
        
		$patient->save();

        if($isNew)
            Session::flash('created_patient', 'The patient has been created.', '');
		else
            Session::flash('updated_patient', 'The patient has been updated.');


        Session::flash('id_patient', $patient->id_patient);
        
        return redirect('admin/patient');
	}
	
    public function deletePatientAjax(Request $request) {
        
        $inputs = $request->all();
        
        $patient = Patient::findOrFail($inputs['id_patient']);

        $deleted = $patient->delete();

        if ($deleted)
            Session::flash('deleted_patient', 'The patient was successfully deleted!');

        if ($deleted) {
            return response()->json(['status'=>'DELETED', 'message' => 'The patient has been deleted.', 'newName' => $patient->first_name . ' ' . $patient->last_name], 200);
        } else
            return response()->json(['message' => 'The patient has not been deleted.'], 401);

    }

    public function getInfoControlPatient(Request $request) {

        $inputs = $request->all();
        $id_patient = $inputs['id_patient'];

        $firstControlVisit = '';
        $lastControlVisit = '';
        $nextControlVisit = '';

        $firstEvent = DB::table('events')
                        ->where('id_patient', $id_patient)
                        ->where('start_time', '<=', Carbon::now() )
                        ->orderBy('start_time', 'asc')
                        ->first();

        $lastEvent = DB::table('events')
                        ->where('id_patient', $id_patient)
                        ->where('start_time', '<=', Carbon::now() )
                        ->orderBy('start_time', 'desc')
                        ->first();

        $nextEvent = DB::table('events')
                        ->where('id_patient', $id_patient)
                        ->where('start_time', '>', Carbon::now() )
                        ->orderBy('start_time', 'asc')
                        ->first();

        // check if object is not null
        if($firstEvent)
            $firstControlVisit = $firstEvent->start_time;

        if($lastEvent)
            $lastControlVisit = $lastEvent->start_time;

        if($nextEvent)
            $nextControlVisit = $nextEvent->start_time;

        return response()->json([
            'firstControl'  => $firstControlVisit,
            'lastControl'   => $lastControlVisit,
            'nextControl'  => $nextControlVisit,
        ], 200);
    }


}
