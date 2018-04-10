<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Product extends Model
{
	/**
	  *	get all products
	  *
	  *	@return Illuminate\Support\Collection|array
	  */
	public static function getAllProducts()
	{
		return self::getTagsByProduct(DB::table('products')->get());
	}
	/**
	  *	get a product by name
	  * @param string $name
	  *
	  *	@return Illuminate\Support\Collection|array
	  */

	public static function getProductById($id)
	{
		return self::getTagsByProduct(DB::table('products')->where('id', $id)->get());
	}


	public static function getProductByName(string $name)
	{
		return self::getTagsByProduct(DB::table('products')->where('name', $name)->get());
	}
	/**
	  *	get all products that have a certain tag
	  *	@param string $category
	  *	
	  *	@return Illuminate\Support\Collection|array
	  */
	public static function getProductsFromTags(string $category)
	{
		$tagId = Category::getCategoryIdByName($category);
		if (empty($tagId)) return array();

		$products = DB::table('product-categories')->select('product_id')->where('categories_id', $tagId->id)->get();

		if (empty($products)) return array();

		$productIds = [];

		foreach ($products as $product) {
			if (isset($product->product_id)) $productIds[] = $product->product_id;
		}
		
		return self::getTagsByProduct(DB::table('products')->whereIn('id', $productIds)->get());
	}

	/**
	  *	adds the tags to the product objects
	  *	@param Illuminate\Support\Collection
	  *	
	  *	@return Illuminate\Support\Collection|array
	  */

	private static function getTagsByProduct($products)
	{
		if (empty($products) || !is_object($products) && !is_array($products) ) return array();

		foreach($products as $product) {
			$product->categories = Category::getCategoryById($product->id); 
		}
		
		return $products;
	}
}
