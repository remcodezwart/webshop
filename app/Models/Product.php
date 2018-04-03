<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public static function test()
	{
		return self::all()->toArray();
	}
}
