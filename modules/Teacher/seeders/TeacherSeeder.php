<?php

namespace Modules\Teacher\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Teacher\src\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
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
            DB::table('teachers')->insert([
            'name' => $faker->name,
            ]);
        }
    }
}
