<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeethsPrize extends Model
{

    protected $fillable = ['detail', 'date', 'currency1', 'price1', 'currency2', 'price2',
                            'currency3', 'price3', 'currency4', 'price4', 'vat', 'note'];
}
