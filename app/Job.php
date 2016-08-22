<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['teeth_no', 'type_cure', 'status_cure', 'short_code', 'date', 'description',
                           'descOfClient', 'currency', 'price', 'quantity', 'discount', 'amount', 'id_teeth_prizes',
                           'id_patient', 'id_chart'];

    // softDelete field
    protected $dates = ['deleted_at'];

}
