<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $faker = Factory::create();
        for ($i=1;$i<=20000;$i++)
        {
            User::create([
               'name'=>$faker->name,
               'email'=>$faker->unique()->safeEmail,
               'password'=>Hash::make($faker->password),
                'email_verified_at'=>now(),
            ]);
        }

    }
}
