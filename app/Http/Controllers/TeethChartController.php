<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeethChartController extends Controller
{

    public function getListCuresByPatient(Request $request) {

        $listCures = Job::all();

        return $listCures;
    }

}
