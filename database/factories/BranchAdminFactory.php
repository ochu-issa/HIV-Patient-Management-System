<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchAdmin>
 */
class BranchAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'f_name' => fake()->firstName(),
            'l_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['male', 'female']),
            'phone_number' => fake()->numerify('+255 7## ### ###'),
            'branch_id' => fake()->numberBetween(1,10),
            'status' => fake()->numberBetween(0,1),
        ];
    }
}
