<?php

namespace App\Http\Controllers;

use App\Patient;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

use App\Http\Requests;

class PatientDataReportController extends Controller
{
    
    public function patientDataReport(Request $request) {

        $patients = Patient::all();

        $pdf = PDF::loadView('report/patient/patient_data_report', ['patients'=>$patients]);
        return $pdf->download('PatientData.pdf');
        
    }
}
