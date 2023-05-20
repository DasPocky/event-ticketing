<?php

namespace Database\Factories;

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
            'user_id' => null,
            'category_id' => null,
            'sub_category_id' => null,
            'venue_id' => null,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'entry_datetime' => $this->faker->dateTime,
            'start_datetime' => $this->faker->dateTime,
            'end_datetime' => $this->faker->dateTime,
            'status' => null,
            'website' => $this->faker->url
        ];
    }
}
