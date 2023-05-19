<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizer>
 */
class OrganizerFactory extends Factory
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
            'name' => $this->faker->company,
            'address' => $this->faker->streetAddress,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
        ];
    }
}
