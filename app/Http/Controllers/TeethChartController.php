<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\patient\chart\CalculateListCuresLogic;
use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeethChartController extends Controller
{

    public function getListCuresByPatient(Request $request) {

        $logicCalculateCuresOfPatient = new CalculateListCuresLogic();
        
        $inputs = $request->all();

        $id_patient = $inputs['idPatient'];

        $listCures = Job::where('id_patient', $id_patient)->get();

        /**
        * Logic method
        */
        $arrayListAndBoject = $logicCalculateCuresOfPatient->calculateAllVariablesListCure($listCures);

        return $arrayListAndBoject;
    }

}
