<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = ['id_patient', 'title', 'content', 'backgroundColor', 'start_time', 'end_time'];

    protected $guarded = ['titleModal', 'contentModal', 'first_name', 'last_name'];

    public function patient() {
        return $this->belongsTo('App\Patient', 'id_patient');
    }

//    public function setIdPatientAttribute($value) {
//        $this->attributes['id_patient'] = $value ?: null;
//    }

}
