<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
    	foreach (range(1,30) as $index) {
        $name = $faker->name;
	        DB::table('products')->insert([
	            'name' => $name,
              'description' => $faker->paragraph,
	            'slug' => str_replace([' ', '.'], '-', $name),
              'category_id' => $faker->numberBetween($min = 1, $max = 10),
              'subcategory_id' => $faker->numberBetween($min = 0, $max = 20)
	        ]);
        }
    }
}
