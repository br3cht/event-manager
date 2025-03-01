<?php

namespace Database\Factories;

use App\Enum\EventStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => EventStatus::Open->value,
            'titulo' => fake()->name(),
            'descricao' => fake()->text(),
            'localizacao' => fake()->text(),
            'capacidade_maxima' => fake()->randomNumber(),
            'inicio' => fake()->dateTime(),
            'final' => fake()->dateTime(),
        ];
    }
}
