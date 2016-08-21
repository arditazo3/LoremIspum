<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Http\BusinessLogic\patient\chart\CalculateListCuresLogic;
use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChartController extends Controller
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
    
    public function checkIfPatientHasChart(Request $request) {
        
        $inputs     = $request->all();
        $id_patient = $inputs['idPatient'];
        
        $charts = Chart::where('id_patient', $id_patient)->get();

        if (sizeof( $charts ) > 0 ) {
            return response()->json(['hasChart' => true, 'listCharts' => $charts], 200);
        } else {
            return response()->json(['hasChart' => false, 'listCharts' => $charts], 200);
        }
    }
    
    public function createNewChart(Request $request) {

        $inputs     = $request->all();
        $id_patient = $inputs['idPatient'];
        
        $newChart = new Chart();
        
        $newChart->id_patient = $id_patient;
        
        $newChart->save();
        
        return $newChart;
    }

}
