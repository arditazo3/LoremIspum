<?php

namespace App\Http\Controllers;

use App\TeethsPrize;
use Illuminate\Http\Request;

use App\Http\Requests;

class CureController extends Controller
{
    
    public function getSelectedCure(Request $request) {
        
        $inputs = $request->all();

        $detailCure = $inputs['cureName'];

        $cureDetail = TeethsPrize::where('detail', $detailCure)->firstOrFail();

        return response()->json(['theCure' => $cureDetail], 200);
    }
    
}
