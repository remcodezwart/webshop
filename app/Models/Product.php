<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\helpers\ShopingCartHelper;

class Product extends Model
{
	protected $appends = ['ShopingAmount'];
    private static $index = 0;
	/**
     * Get all the order amounts from the session
     *
     * @return array
     */
    public function getShopingAmountAttribute()
    {
        $session = session(ShopingCartHelper::CART);
        if (empty($session)) return ;
        $amount = array_filter(session(ShopingCartHelper::CART), array($this, 'compareId'));
        $amount = $amount[self::$index]->amount;
        self::$index++;
        return $amount;
    }

	public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product-categories', 'product_id', 'categories_id' );
    }

    public function compareId($value)
    {
        if ($value->id == $this->id) {
            return true;
        }
    }
}
