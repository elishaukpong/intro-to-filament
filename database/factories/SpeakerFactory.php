<?php

namespace Database\Factories;

use App\Models\Talk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Speaker;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $qualifications = $this->faker->randomElement(
            array_keys(Speaker::QUALIFICATIONS, $this->faker->numberBetween(0,count(Speaker::QUALIFICATIONS)))
        );

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'bio' => $this->faker->text(),
            'twitter_handle' => $this->faker->word(),
            'qualifications' => $qualifications
        ];
    }

    public function withTalks(int $count = 1): SpeakerFactory
    {
        return $this->has(Talk::factory()->count($count));
    }
}
