<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardOccasionEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GenerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_form_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/e-card/generate');

        $response
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function test_e_cards_can_be_generated(): void
    {
        Storage::fake('spaces');

        $this->seed();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/e-card/generate', [
                'recipient_name' => 'Test User',
                'occasion' => ECardOccasionEnum::EASTER->value,
                'additional_prompt_details' => 'test prompt',
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

    public function test_e_card_form_fields_must_be_provided()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/e-card/generate');

        $response
            ->assertSessionHasErrors('recipient_name')
            ->assertSessionHasErrors('occasion');
    }
}
