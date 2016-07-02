<?php

use Carbon\Carbon;
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
        $marital_status = DB::table('domains')->where('des_dom', 'marital_status')->lists('value');
        $language = DB::table('domains')->where('des_dom', 'language')->lists('value');
        $proffession = DB::table('domains')->where('des_dom', 'proffession')->lists('value');

        $faker = Faker::create();
        for ($index = 0; $index < 25; $index++) {

            \Illuminate\Support\Facades\DB::table('patients')->insert([
                'id_patient' => 'PA' . time() . $index,
                'first_name' => $faker->name,
                'last_name' => $faker->lastName,
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
                'date_birth' => Carbon::now()->addDays( random_int(1, 100) ) ,
//                'date_birth' =>  date ("d/m/Y", ((string)random_int(1, 30) . '/' .
//                                                 (string)random_int(1, 12) .  '/' .
//                                                 (string)random_int(1950, 2015) ) ),
                'birth_place' => $cities[ random_int(0, (sizeof($cities)-1) ) ],
                'marital_status' => $marital_status[ random_int(0, (sizeof($marital_status)-1) ) ],
                'language' => $language[ random_int(0, (sizeof($language)-1) ) ],
                'proffession' => $proffession[ random_int(0, (sizeof($proffession)-1) ) ],
                'personal_phone' => $faker->phoneNumber,
                'office_phone' => $faker->phoneNumber,
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
