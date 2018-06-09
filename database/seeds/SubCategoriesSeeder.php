<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        DB::table('sub_categories')->insert([
              'category_id' => $faker->numberBetween($min = 0, $max = 10),
              'name' => $faker->word
	        ]);
        }
    }
}
