<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'middleinitial' => ucfirst($this->faker->randomLetter),
            'student_no' => $this->faker->unique()->regexify('[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0-9]'),
            'section' => $this->faker->randomElement(['BSIT-1A', 'BSIT-1B', 'BSIT-1C', 'BSIT-2A', 'BSIT-2B', 'BSIT-2C', 'BSIT-3A', 'BSIT-3B', 'BSIT-3C', 'BSIT-4A', 'BSIT-4B', 'BSIT-4C']),
            'role' => $this->faker->randomElement(['student', 'professor']),
            'token' => Str::random(20),
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('123'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'approved' => $this->faker->randomElement([true, false]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
