<?php

namespace App\Http\Controllers;

use App\Job;
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

    public function saveUpdateCureAjax(Request $request) {


        $inputs = $request->all();
        $id = $inputs['id'];
        $isEditableModal = filter_var($inputs['isEditableModal'], FILTER_VALIDATE_BOOLEAN);

        if ($isEditableModal) {
            Job::find($id)->update($inputs);
        } else {
            Job::create($inputs);
        }

        return response()->json(['message' => 'The cure has been saved.'], 200);
    }
    
}
