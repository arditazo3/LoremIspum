<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Variables used to save the Patient
    protected $fillable = [
        'id_patient', 'first_name', 'last_name', 'address', 'nation', 'city',
        'zip_code', 'adult_child','sex','date_birth', 'birth_place',
        'marital_status', 'language', 'id_dentist', 'tax_code', 'proffession',
        'personal_phone', 'office_phone', 'email'
    ];


    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     */
    public $incrementing = false;

    public $primaryKey = 'id_patient';
}
