<?php

namespace Modules\User\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User();
        // $user->name = 'Pham Hong Truong';
        // $user->username = 'Truong.DEV';
        // $user->email = 'truong.pham@adnx.vn';
        // $user->password = Hash::make('123456');
        // $user->group_id = 1;
        // $user->save();
        $faker = Factory::create();
        $limit = 20;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->unique()->email,
            'password' => Hash::make('123456'),
            'group_id' => $faker->numberBetween(1,4)
        ]);
        }
    }
}
