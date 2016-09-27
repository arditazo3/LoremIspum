<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chart extends Model
{

    use SoftDeletes;
    
    // 'id_patient'
    protected $fillable = ['id_user', 'id_chart'];

    public $primaryKey = 'id_chart';
    
    // softDelete field
    protected $dates = ['deleted_at'];

    public function patient() {
        return $this->belongsTo('App\Patient', 'id_patient');
    }

    public function jobs() {
        return $this->hasMany('App\Job', 'id_chart');
    }
    
}
