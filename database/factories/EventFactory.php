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
        $fakerFileName = $this->faker->image(
            storage_path("app/public/images/events"),
            1920,
            1080
        );

        return [
            'user_id' => null,
            'category_id' => null,
            'sub_category_id' => null,
            'venue_id' => null,
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'entry_datetime' => $this->faker->dateTime(),
            'start_datetime' => $this->faker->dateTime(),
            'end_datetime' => $this->faker->dateTime(),
            'status' => 1,
            'image' => 'images/events/' . basename($fakerFileName),
            'website' => $this->faker->url(),
        ];
    }
}
