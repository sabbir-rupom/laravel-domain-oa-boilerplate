<?php

namespace App\Domains\SimplePage\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'price',
        'stock',
    ];

}
