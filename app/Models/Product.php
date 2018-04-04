<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Product extends Model
{
	/*
		get all products

		return Illuminate\Support\Collection
	*/
	public static function getAllProducts()
	{
		$products = DB::table('products')->get();

		foreach($products as $product) {
			$product->categories = Category::getCategoryById($product->id); 
		}
		
		return $products;
	}
	/*
		get all products that have a certain tag

		return Illuminate\Support\Collection
	*/
	public static function getProductsFromTags(string $name)
	{
		$tagId = Category::getCategoryIdByName($name);
		if (is_null($tagId)) return array();

		$productIds = DB::table('product-categories')->select('product_id')->where('categories_id', $tagId->id)->get();

		//TODO:Finish function
	}
}
