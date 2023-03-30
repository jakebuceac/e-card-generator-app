<?php

namespace Database\Factories;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ECard>
 */
class ECardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'thumbnail_url' => fake()->imageUrl(),
            'size' => ECardSizeEnum::SMALL->value,
            'occasion' => ECardOccasionEnum::BIRTHDAY->value,
        ];
    }
}
