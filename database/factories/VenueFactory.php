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
        return [
            // Erstelle eine Factory für das Model Venue
            //        'user_id',
            //        'name',
            //        'address',
            //        'zip',
            //        'city',
            //        'country',
            //        'contact_name',
            //        'contact_phone',
            //        'contact_email',
            //        'notes',

            'user_id' => null,
            'name' => $this->faker->company,
            'address' => $this->faker->streetAddress,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'contact_name' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->email,
            'notes' => $this->faker->text,
        ];
    }
}
