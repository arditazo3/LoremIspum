<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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

        $cities = DB::table('domains')->where('des_dom', 'cities')->lists('value');
        $countries = DB::table('domains')->where('des_dom', 'countries')->lists('value');
        $adult = DB::table('domains')->where('des_dom', 'adult')->lists('value');
        $gender = DB::table('domains')->where('des_dom', 'gender')->lists('value');

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
                'nation' => $countries[ random_int(0, (sizeof($countries)-1) ) ],
                'city' => $cities[ random_int(0, (sizeof($cities)-1) ) ],
                'adult_child' => $adult[ random_int(0, (sizeof($adult)-1) ) ],
                'sex' => $gender[ random_int(0, (sizeof($gender)-1) ) ],
                'zip_code' => (string)random_int(1000, 9999),
                'tax_code' => $faker->creditCardNumber(),
                'date_birth' =>  date('d-m-Y', mt_rand(1262055681,1262055681) ) ,
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
