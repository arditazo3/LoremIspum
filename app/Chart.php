<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chart extends Model
{

    use SoftDeletes;
    
    protected $fillable = ['id_patient', 'id_user'];

    // softDelete field
    protected $dates = ['deleted_at'];

}
