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
        $faker = Faker::create();
        for ($index = 0; $index < 50; $index++) {

            \Illuminate\Support\Facades\DB::table('patients')->insert([
                'first_name' => $faker->name,
                'last_name' => $faker->lastName
            ]);
        }
    }
}
