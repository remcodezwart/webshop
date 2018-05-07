<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_lines extends Model
{
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
