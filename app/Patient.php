<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{

    use SoftDeletes;

    // Variables used to save the Patient
    protected $fillable = [
        'id_patient', 'first_name', 'last_name', 'address', 'nation', 'city',
        'zip_code', 'adult_child','sex','date_birth', 'birth_place',
        'marital_status', 'language', 'id_dentist', 'tax_code', 'proffession',
        'personal_phone', 'office_phone', 'email', 'image_id', 'image_path',
        'note1', 'note2','note3','note4'
    ];


    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     */
    public $incrementing = false;

    public $primaryKey = 'id_patient';

    // softDelete field
    protected $dates = ['deleted_at'];

    public function image() {
        return $this->belongsTo('App\Image');
    }

    public function events() {
        return $this->hasMany('App\Event', 'id_patient');
    }

    public function charts() {
        return $this->hasMany('App\Chart', 'id_patient');
    }

}
