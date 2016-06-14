<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = ['name', 'title', 'start_time', 'end_time'];

    protected $guarded = ['nameModal', 'titleModal'];
}
