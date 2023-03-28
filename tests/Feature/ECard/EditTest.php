<?php

namespace Tests\Feature\ECard;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditTest extends TestCase
{
    public function test_temporary_e_cards_are_deleted(): void
    {
        Storage::fake('s3');

        $user = User::factory()->create();
        $testFilePath = base_path('tests/Stubs/Test_256x256.png');
        $temporaryFilePath = '/' . $user->id . '/e-cards/temporary/Test_256x256.png';
        $thumbnailTemporaryFilePath = '/' . $user->id . '/e-cards/thumbnails/temporary/Test_256x256.png';

        Storage::put($temporaryFilePath, file_get_contents($testFilePath));
        Storage::put($thumbnailTemporaryFilePath, file_get_contents($testFilePath));

        $sessionCollection = collect([
            [
                'fileName' => 'Test_256x256.png',
                'url' => Storage::url($temporaryFilePath),
                'header' => 'test header',
                'message' => 'test message',
                'fontColour' => '#000000',
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession(['images' => $sessionCollection])
            ->get('/e-card/edit/Test_256x256.png');

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
}
