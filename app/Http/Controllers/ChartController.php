<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Http\BusinessLogic\patient\chart\ChartLogic;
use App\Job;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Requests;

class ChartController extends Controller
{

    public function getListCuresByPatient(Request $request) {

        $logicCalculateCuresOfPatient = new ChartLogic();
        
        $inputs = $request->all();

        $id_chart = $inputs['id_chart'];

        $chart = Chart::findOrFail($id_chart);

        $listCures = $chart->jobs()->get();

        /**
        * Logic method
        */
        $arrayListAndBoject = $logicCalculateCuresOfPatient->calculateAllVariablesListCure($listCures);

        return $arrayListAndBoject;
    }
    
    public function checkIfPatientHasChart(Request $request) {
        
        $inputs     = $request->all();
        $id_patient = $inputs['idPatient'];

        $patient = Patient::findOrFail($id_patient);

        $charts = $patient->charts()->get();

        if (sizeof( $charts ) > 0 ) {
            return response()->json(['hasChart' => true, 'listCharts' => $charts, 
                'patient' => $patient], 200);
        } else {
            return response()->json(['hasChart' => false, 'listCharts' => $charts, 
                'patient' => $patient], 200);
        }
    }
    
    public function createNewChart(Request $request) {

        $logicCalculateCuresOfPatient = new ChartLogic();

        $inputs     = $request->all();
        $newChart = new Chart();

        $newChart = $logicCalculateCuresOfPatient->createNewChartDefault($newChart, $inputs);
        
        return $newChart;
    }

}
