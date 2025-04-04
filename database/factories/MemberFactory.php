<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => fake()->name(),
            'mname' => fake()->name(),
            'lname' => fake()->name(),
            'bday' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),

        ];
    }
}
