<?php

namespace Tests\Feature\ECard;

use App\Actions\CreateDefaultDesignStateAction;
use App\Enum\ECardOccasionEnum;
use App\Models\ECard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ECardStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_temporary_e_cards_are_deleted(): void
    {
        Storage::fake('spaces');

        $user = User::factory()->create();

        $testFilePath = base_path('tests/Stubs/Test_256x256.png');
        $temporaryFilePath = '/' . $user->id . '/e-cards/temporary/Test_256x256.png';
        $thumbnailTemporaryFilePath = '/' . $user->id . '/e-cards/thumbnails/temporary/Test_256x256.png';

        Storage::put($temporaryFilePath, file_get_contents($testFilePath), 'public');
        Storage::put($thumbnailTemporaryFilePath, file_get_contents($testFilePath), 'public');

        $response = $this
            ->actingAs($user)
            ->post('/e-card', [
                'name' => 'Test_256x256.png',
                'occasion' => ECardOccasionEnum::EASTER->value,
                'image_size' => '256x256',
                'header' => 'test header',
                'message' => 'test message',
                'font_colour' => '#000000',
            ]);

        $eCard = ECard::with('eCardInformation')->where('name', '=', 'Test_256x256.png')->first();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/e-card/' . $eCard->id);

        $eCardsTemporaryPath = '/' . $user->id . '/e-cards/temporary/';
        $thumbnailsTemporaryPath = '/' . $user->id . '/e-cards/thumbnails/temporary/';

        $this->assertTrue(Storage::exists($eCardsTemporaryPath));
        $this->assertTrue(Storage::exists($thumbnailsTemporaryPath));

        $this->assertEmpty(Storage::allFiles($eCardsTemporaryPath));
        $this->assertEmpty(Storage::allFiles($thumbnailsTemporaryPath));
    }

    public function test_e_cards_are_stored_on_database(): void
    {
        Storage::fake('spaces');

        $user = User::factory()->create();

        $testFilePath = base_path('tests/Stubs/Test_256x256.png');
        $temporaryFilePath = '/' . $user->id . '/e-cards/temporary/Test_256x256.png';
        $thumbnailTemporaryFilePath = '/' . $user->id . '/e-cards/thumbnails/temporary/Test_256x256.png';

        Storage::put($temporaryFilePath, file_get_contents($testFilePath), 'public');
        Storage::put($thumbnailTemporaryFilePath, file_get_contents($testFilePath), 'public');

        $response = $this
            ->actingAs($user)
            ->post('/e-card', [
                'name' => 'Test_256x256.png',
                'occasion' => ECardOccasionEnum::EASTER->value,
                'image_size' => '256x256',
                'header' => 'test header',
                'message' => 'test message',
                'font_colour' => '#000000',
            ]);

        $eCard = ECard::with('eCardInformation')->where('name', '=', 'Test_256x256.png')->first();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/e-card/' . $eCard->id);

        $eCardPath = '/' . $user->id . '/e-cards/Test_256x256.png';
        $thumbnailPath = '/' . $user->id . '/e-cards/thumbnails/Test_256x256.png';

        $this->assertDatabaseHas('e_cards', [
            'user_id' => $user->id,
            'name' => 'Test_256x256.png',
            'thumbnail_url' => Storage::url($thumbnailPath),
            'size' => '256x256',
            'occasion' => ECardOccasionEnum::EASTER->value,
        ]);

        $eCard = ECard::where('user_id', '=', $user->id)->first();

        $assets = (new CreateDefaultDesignStateAction())->execute(
            Storage::url($eCardPath),
            'test header',
            'test message',
            ECardOccasionEnum::EASTER->value,
            '256x256',
        );
        $this->assertDatabaseHas('e_card_information', [
            'e_card_id' => $eCard->id,
            'image_url' => Storage::url($eCardPath),
            'assets' => $this->castAsJson($assets),
        ]);
    }

    public function test_e_card_fields_must_be_provided(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/e-card');

        $response
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('occasion')
            ->assertSessionHasErrors('image_size')
            ->assertSessionHasErrors('header')
            ->assertSessionHasErrors('message')
            ->assertSessionHasErrors('font_colour');
    }
}
