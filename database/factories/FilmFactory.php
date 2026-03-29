<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->sentence(3),
            'year'=>$this->faker->year(),
            'genre'=>$this->faker->randomElement(['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi']),
            'country'=>$this->faker->country(),
            'duration'=>$this->faker->numberBetween(80, 180),
            'rating'=>$this->faker->randomFloat(1, 1, 5),
            'img_url'=>$this->faker->imageUrl(400, 400, 'films', true)  
        ];
    }
}
