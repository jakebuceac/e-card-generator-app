<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake('s3');

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

        $eCardsTemporaryPath = '/' . $user->id . '/e-cards/temporary/';
        $thumbnailsTemporaryPath = '/' . $user->id . '/e-cards/thumbnails/temporary/';

        $this->assertTrue(Storage::exists($eCardsTemporaryPath));
        $this->assertTrue(Storage::exists($thumbnailsTemporaryPath));

        $this->assertTrue(count(Storage::allFiles($eCardsTemporaryPath)) === 6);
        $this->assertTrue(count(Storage::allFiles($thumbnailsTemporaryPath)) === 6);
    }
}
