<?php

namespace Modules\Course\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Course\src\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CourseSeeder extends Seeder
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
            DB::table('courses')->insert([
                'name' => $faker->name,
            ]);
        }
    }
}
