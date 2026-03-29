<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'surname'=>$this->faker->lastName(),
            'birthdate'=>$this->faker->date(),
            'country'=>$this->faker->country(),
            'salary'=>$this->faker->numberBetween(100000, 1000000),
            'img_url'=>$this->faker->imageUrl(400, 400, 'actors', true)
        ];
    }
}
