<?php

namespace Database\Factories;

use App\Actions\CreateDefaultDesignStateAction;
use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Models\ECard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ECardInformation>
 */
class ECardInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'e_card_id' => ECard::factory(),
            'image_url' => fake()->imageUrl(),
            'assets' => $this->assets(),
        ];
    }

    private function assets(): string
    {
        $imageUrl = fake()->imageUrl();
        $header = fake()->text();
        $message = fake()->sentence();
        $occasion = ECardOccasionEnum::BIRTHDAY->value;
        $size = ECardSizeEnum::SMALL->value;

        return (new CreateDefaultDesignStateAction())->execute($imageUrl, $header, $message, $occasion, $size);
    }
}
