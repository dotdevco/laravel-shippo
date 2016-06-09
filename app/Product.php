<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'length', 'width', 'height', 'distance_unit', 'weight', 'mass_unit',
    ];
}
