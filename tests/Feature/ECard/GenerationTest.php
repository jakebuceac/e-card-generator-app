<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Models\User;
use Tests\TestCase;

class GenerationTest extends TestCase
{
    public function test_generate_form_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/e-card/generate');

        $response->assertOk();
    }

    public function test_e_cards_can_be_generated(): void
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/e-card/generate', [
                'recipient_name' => 'Test User',
                'image_size' => ECardSizeEnum::SMALL->value,
                'occasion' => ECardOccasionEnum::EASTER->value,
                'personal_message' => 'test message',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();
    }
}
