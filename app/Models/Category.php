<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product-categories', 'categories_id', 'product_id' );
    }
}
