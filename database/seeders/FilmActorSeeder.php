<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $faker = Faker::create();
        
        $filmIds = DB::table('films')->pluck('id')->toArray();
        
        $actorIds = DB::table('actors')->pluck('id')->toArray();
        
        if (empty($filmIds) || empty($actorIds)) {
            $this->command->error("Please run FilmFakerSeeder and ActorFakerSeeder first!");
            return;
        }
        
        foreach ($filmIds as $filmId) {
            $numberOfActors = $faker->numberBetween(1, 3);
            
            $selectedActors = $faker->randomElements($actorIds, $numberOfActors);
            
            foreach ($selectedActors as $actorId) {
                DB::table('films_actors')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        $this->command->info("Films_actors table ");
    }
}