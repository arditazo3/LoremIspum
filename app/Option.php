<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    
    protected $fillable = ['option', 'section', 'description', 'value'];
}
