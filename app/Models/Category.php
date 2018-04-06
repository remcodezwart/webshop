<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Category extends Model
{
   /**
   * return all the catogories
   *
   * @return return Illuminate\Support\Collection
   */

   public static function getAllCategories()
   {
      return DB::table('categories')->get();
   }
   /**
     * return all the catogories of a given product id.
     * @param int id
     *
     * @return return Illuminate\Support\Collection|array
     */

   public static function getCategoryById(int $id)
   {
   	
   		$categories = DB::table('product-categories')->where('product_id', $id)->select('categories_id')->get();
   		
   		$categorieToReturn = array();//we just need the value of the catogories as a string so we add them to another array and this array we return

   		foreach($categories as $category) {;
        $validate = DB::table('categories')->where('id', $category->categories_id)->select('name')->first();
        if (isset($validate->name)) $categorieToReturn[] = $validate->name;
   		}

   		return $categorieToReturn;
   }

   /**
     * gets all the categories by name
     * @param int id
     *
     * @return return Illuminate\Support\Collection
     */


   public static function getCategoryIdByName($name)
   {
      return DB::table('categories')->where('name', $name)->first();
   }
}
