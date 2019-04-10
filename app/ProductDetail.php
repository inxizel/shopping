<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
    	'id',
        'product_id',
        'product_code', 
        'size_id',
        'color_id',
        'quantity'
    ];
}
