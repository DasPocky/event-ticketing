<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFileName = $this->faker->image(
            storage_path("app/public/images/venues"),
            1920,
            1080
        );

        return [
            'user_id' => null,
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'zip' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'image' => 'images/venues/' . basename($fakerFileName),
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->email(),
            'notes' => $this->faker->text(),
        ];
    }
}
