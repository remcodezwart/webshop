<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => str_random(10),
            'description' => str_random(50),
            'amount' => random_int(1, 100),
            'price' => rand(0, 20)
        ]);
    }
}
