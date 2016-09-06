<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Option;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChartsPageController extends Controller
{

    public function index() {

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


        return view('webapp-layouts.patient.chart_page.chart_main',
            compact('website', 'listCures', 'typeCure', 'statusCure', 'listUsers'));
    }

}
