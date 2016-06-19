<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * CODE TO RUN: php artisan db:seed
         */

        $faker = Faker::create();
        for ($index = 0; $index < 50; $index++) {

            \Illuminate\Support\Facades\DB::table('patients')->insert([
                'id_patient' => 'PA' . time() . $index,
                'first_name' => $faker->name,
                'last_name' => $faker->lastName,
                'proffession' => $faker->jobTitle,
                'company_name' => $faker->company,
                'address' => $faker->address,
                'city' => $faker->city,
                'language' => $faker->languageCode,
                'email' => $faker->email,
            ]);

            \Illuminate\Support\Facades\DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);

        }
    }
}
