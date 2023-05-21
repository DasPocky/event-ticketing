<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //        'event_id',
            //        'name',
            //        'quantity',
            //        'quantity_sold',
            //        'price',

            'event_id' => null,
            'name' => null,
            'quantity' => $this->faker->numberBetween(1, 100),
            'quantity_sold' => 0,
            'price' => $this->faker->numberBetween(5, 200),
        ];
    }
}
