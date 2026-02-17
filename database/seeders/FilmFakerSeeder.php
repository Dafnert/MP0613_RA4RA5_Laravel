<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $genres = ['Action', 'Drama', 'Comedy', 'Horror', 'Sci-Fi', 'Romance', 'Thriller', 'Adventure', 'Fantasy', 'Documentary'];

        $countries = ['USA', 'UK', 'France', 'Spain', 'Italy', 'Germany', 'Japan', 'South Korea', 'Canada', 'Australia'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([
                'name' => $faker->words(rand(2, max: 4), true) . ' ' . $faker->randomElement(['Chronicles', 'Returns', 'Awakens', 'Legacy', 'Origins']),
                'year' => $faker->numberBetween(2000, 2026),
                'genre' => $faker->randomElement($genres),
                'country' => $faker->randomElement($countries),
                'duration' => $faker->numberBetween(80, 180), 
                'img_url' => $faker->imageUrl(640, 480, 'movie', true, 'Film'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info("Films table");
    }
}