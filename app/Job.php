<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['teeth_no', 'typeCure', 'statusCure', 'shortCode', 'date', 'description',
                           'descOfClient', 'currency', 'price', 'quantity', 'discount', 'amount', 'id_teeth_prizes',
                           'id_patient'];

    // softDelete field
    protected $dates = ['deleted_at'];

}
