<?php

namespace Modules\Dog\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Dog\src\Models\Dog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DogSeeder extends Seeder
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
        for ($i = 0; $i < $limit; $i++) {
            DB::table('dogs')->insert([
            'name' => $faker->name,
            ]);
        }
    }
}
