<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'id',
        'name',
        'product_code', 
        'user_id',
        'description',
        'category_id',
        'slug',
        'brand_id',
        'category_id',
        'product_info',
        'price',
        'discount_price'
    ];

    public function brand()
    {
        return $this->hasOne('App\Brand');
    }
}
