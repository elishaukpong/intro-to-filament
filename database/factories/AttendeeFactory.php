<?php

namespace Database\Factories;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendee>
 */
class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'ticket_cost' => $this->faker->numerify('#####'),
            'is_paid' => true,
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }

    public function forConference(Conference $conference): self
    {
        return $this->state([
            'conference_id' => $conference->id,
        ]);
    }
}
