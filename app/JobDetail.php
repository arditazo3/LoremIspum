<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{

    use SoftDeletes;

    // softDelete field
    protected $dates = ['deleted_at'];

}
