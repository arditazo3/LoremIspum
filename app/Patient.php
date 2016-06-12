<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Variables used to save the Patient
    protected $fillable = [
        'first_name', 'last_name','address','nation','city',
        'zip_code', 'adult_child','sex','date_birth','birth_place',
        'marital_status', 'language','id_dentist','tax_code','proffession',
        'personal_phone', 'office_phone','email'
    ];

}
