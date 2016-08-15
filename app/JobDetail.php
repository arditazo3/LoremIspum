<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDetail extends Model
{

    use SoftDeletes;

    // softDelete field
    protected $dates = ['deleted_at'];

}
