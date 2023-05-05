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
        $status = ['normal','require','emergency'];
        return [
            'subject' => fake()->realText(random_int(20,65)),
            'status' => $status[random_int(0,2)],
            'message' => fake()->realText(random_int(100,200))
        ];
    }
}
