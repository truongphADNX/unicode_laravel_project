<?php

namespace Modules\Categories\seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Factory::create();
       $limit = 20;
       for ($i=0; $i < $limit; $i++) {
        $slug = $faker->slug;
        $name = str_replace("-"," ", $slug);
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => $slug,
                'parent_id' => $faker->randomDigit
            ]);
       }
    }
}
