<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardOccasionEnum;
use App\Models\ECard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_temporary_e_cards_are_deleted(): void
    {
        Storage::fake('s3');

        $user = User::factory()->create();

        $testFilePath = base_path('tests/Stubs/Test_256x256.png');
        $temporaryFilePath = '/' . $user->id . '/e-cards/temporary/Test_256x256.png';
        $thumbnailTemporaryFilePath = '/' . $user->id . '/e-cards/thumbnails/temporary/Test_256x256.png';

        Storage::put($temporaryFilePath, file_get_contents($testFilePath));
        Storage::put($thumbnailTemporaryFilePath, file_get_contents($testFilePath));

        $response = $this
            ->actingAs($user)
            ->post('/e-card', [
                'name' => 'Test_256x256.png',
                'occasion' => ECardOccasionEnum::EASTER->value,
                'header' => 'test header',
                'message' => 'test message',
                'font_colour' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();

        $eCardsTemporaryPath = '/' . $user->id . '/e-cards/temporary/';
        $thumbnailsTemporaryPath = '/' . $user->id . '/e-cards/thumbnails/temporary/';

        $this->assertTrue(Storage::exists($eCardsTemporaryPath));
        $this->assertTrue(Storage::exists($thumbnailsTemporaryPath));

        $this->assertTrue(count(Storage::allFiles($eCardsTemporaryPath)) === 0);
        $this->assertTrue(count(Storage::allFiles($thumbnailsTemporaryPath)) === 0);
    }

    public function test_e_cards_are_stored_on_database(): void
    {
        Storage::fake('s3');

        $user = User::factory()->create();

        $testFilePath = base_path('tests/Stubs/Test_256x256.png');
        $temporaryFilePath = '/' . $user->id . '/e-cards/temporary/Test_256x256.png';
        $thumbnailTemporaryFilePath = '/' . $user->id . '/e-cards/thumbnails/temporary/Test_256x256.png';

        Storage::put($temporaryFilePath, file_get_contents($testFilePath));
        Storage::put($thumbnailTemporaryFilePath, file_get_contents($testFilePath));

        $response = $this
            ->actingAs($user)
            ->post('/e-card', [
                'name' => 'Test_256x256.png',
                'occasion' => ECardOccasionEnum::EASTER->value,
                'header' => 'test header',
                'message' => 'test message',
                'font_colour' => '#000000',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();

        $eCardPath = '/' . $user->id . '/e-cards/Test_256x256.png';
        $thumbnailPath = '/' . $user->id . '/e-cards/thumbnails/Test_256x256.png';

        $this->assertDatabaseHas('e_cards', [
            'user_id' => $user->id,
            'thumbnail_url' => Storage::url($thumbnailPath),
            'size' => Storage::size($eCardPath),
            'occasion' => ECardOccasionEnum::EASTER->value,
        ]);

        $eCard = ECard::where('user_id', '=', $user->id)->first();

        $assets = collect(['header' => 'test header', 'message' => 'test message', 'font_colour' => '#000000'])->toArray();

        $this->assertDatabaseHas('e_card_information', [
            'e_card_id' => $eCard->id,
            'image_url' => Storage::url($eCardPath),
            'assets' => $this->castAsJson($assets),
        ]);
    }
}
