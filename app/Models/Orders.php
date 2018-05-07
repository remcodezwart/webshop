<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function orderLines()
    {
        return $this->hasMany('App\Models\Order_Lines', 'order_id', 'id');
    }
}
