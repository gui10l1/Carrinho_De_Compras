<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'product_name', 'product_price', 'product_description', 'id_user', 'id_product'
    ];
}
