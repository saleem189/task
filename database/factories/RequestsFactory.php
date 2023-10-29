<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requests>
 */
class RequestsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'id' => $this->faker->uuid(),
            'sender_id' => $this->faker->randomElement($userIds),
            'receiver_id' => $this->faker->randomElement($userIds),
            'status' => $this->faker->randomElement(['approved', 'rejected', 'withdrawn', 'pending']),
        ];
    }
}
