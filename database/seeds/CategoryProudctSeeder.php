<?php

use Illuminate\Database\Seeder;

class CategoryProudctSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product-categories')->insert([
            'product_id' => rand(1, 10),
            'categories_id' => rand(1, 10)
        ]);
    }
}
