<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement(['receptionist', 'cleaner', 'security', 'manager', 'supervisor']),
            'tel' => fake()->phoneNumber(),
            'alternative_tel' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'id_type' => fake()->randomElement(['nin', 'passport', 'voters card', 'lassra', 'drivers license']),
            'id_number' => rand(1000000000,9999999999),
            'status' => fake()->randomElement(['active', 'inactive']),
            'hire_date' => fake()->date(),
            'shift_type' => fake()->randomElement(['morning', 'afternoon', 'night']),
            'shift_start_time' => fake()->time(),
            'shift_end_time' => fake()->time(),
        ];
    }
}
