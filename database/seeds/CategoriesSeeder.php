<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
    	foreach (range(1,10) as $index) {
        $word = $faker->word;
	        DB::table('categories')->insert([
	            'name' => $word,
	            'slug' => str_replace([' ', '.'], '-', $word),
	        ]);
        }
    }
}
