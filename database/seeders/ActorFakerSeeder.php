<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Array of countries
        $countries = ['USA', 'UK', 'France', 'Spain', 'Italy', 'Germany', 'Japan', 'South Korea', 'Canada', 'Australia'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birthdate' => $faker->date('Y-m-d', '-18 years'), 
                'country' => $faker->randomElement($countries),
                'img_url' => $faker->imageUrl(640, 480, 'people', true, 'Actor'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info("Actors table");
    }
}