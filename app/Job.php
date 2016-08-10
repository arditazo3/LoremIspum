<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    use SoftDeletes;

    // softDelete field
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
