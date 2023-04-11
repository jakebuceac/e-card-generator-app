<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardSizeEnum;
use App\Models\ECard;
use App\Models\ECardInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_users_e_card_and_its_relationships_are_deleted_from_the_database(): void
    {
        Storage::fake('spaces');

        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();
        $eCard = $user->eCards()->first();
        $eCardInformation = $eCard->eCardInformation;

        $testFilePath = base_path('tests/Stubs/Test_512x512.png');
        $filePath = '/' . $user->id . '/e-cards/Test_512x512.png';
        $thumbnailFilePath = '/' . $user->id . '/e-cards/thumbnails/Test_512x512.png';

        Storage::put($thumbnailFilePath, file_get_contents($testFilePath), 'public');
        Storage::put($filePath, file_get_contents($testFilePath), 'public');

        $eCard->thumbnail_url = Storage::url($thumbnailFilePath);
        $eCard->name = 'Test_512x512.png';
        $eCard->save();

        $eCardInformation->image_url = Storage::url($filePath);
        $eCardInformation->save();

        $this->assertDatabaseHas('e_cards', [
            'id' => $eCard->id,
            'user_id' => $user->id,
            'thumbnail_url' => Storage::url($thumbnailFilePath),
            'name' => 'Test_512x512.png',
            'size' => ECardSizeEnum::MEDIUM->value,
            'occasion' => $eCard->occasion,
        ]);

        $this->assertDatabaseHas('e_card_information', [
            'id' => $eCardInformation->id,
            'e_card_id' => $eCard->id,
            'image_url' => Storage::url($filePath),
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('/e-card/' .  $eCard->id);

        $response
            ->assertFound()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('e_cards', [
            'id' => $eCard->id,
            'user_id' => $user->id,
            'thumbnail_url' => Storage::url($thumbnailFilePath),
            'name' => 'Test_512x512.png',
            'size' => ECardSizeEnum::MEDIUM->value,
            'occasion' => $eCard->occasion,
        ]);
        $this->assertDatabaseCount('e_cards', 0);

        $this->assertDatabaseMissing('e_card_information', [
            'id' => $eCardInformation->id,
            'e_card_id' => $eCard->id,
            'image_url' => Storage::url($filePath),
        ]);
        $this->assertDatabaseCount('e_card_information', 0);
    }

    public function test_a_users_e_card_are_deleted_from_spaces_bucket(): void
    {
        Storage::fake('spaces');

        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();
        $eCard = $user->eCards()->first();
        $eCardInformation = $eCard->eCardInformation;

        $testFilePath = base_path('tests/Stubs/Test_512x512.png');
        $filePath = '/' . $user->id . '/e-cards/Test_512x512.png';
        $thumbnailFilePath = '/' . $user->id . '/e-cards/thumbnails/Test_512x512.png';

        Storage::put($thumbnailFilePath, file_get_contents($testFilePath), 'public');
        Storage::put($filePath, file_get_contents($testFilePath), 'public');

        $this->assertTrue(Storage::exists($thumbnailFilePath));
        $this->assertTrue(Storage::exists($filePath));

        $eCard->thumbnail_url = Storage::url($thumbnailFilePath);
        $eCard->name = 'Test_512x512.png';
        $eCard->save();

        $eCardInformation->image_url = Storage::url($filePath);
        $eCardInformation->save();

        $response = $this
            ->actingAs($user)
            ->delete('/e-card/' .  $eCard->id);

        $response
            ->assertFound()
            ->assertSessionHasNoErrors();

        $this->assertEmpty(Storage::allFiles($thumbnailFilePath));
        $this->assertEmpty(Storage::allFiles($filePath));
    }

    public function test_users_see_403_when_trying_to_delete_an_e_card_not_made_by_them(): void
    {
        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();
        $eCard = $user->eCards()->first();
        $eCardInformation = $eCard->eCardInformation;

        $testFilePath = base_path('tests/Stubs/Test_512x512.png');
        $filePath = '/' . $user->id . '/e-cards/Test_512x512.png';
        $thumbnailFilePath = '/' . $user->id . '/e-cards/thumbnails/Test_512x512.png';

        Storage::put($thumbnailFilePath, file_get_contents($testFilePath), 'public');
        Storage::put($filePath, file_get_contents($testFilePath), 'public');

        $eCard->thumbnail_url = Storage::url($thumbnailFilePath);
        $eCard->name = 'Test_512x512.png';
        $eCard->save();

        $eCardInformation->image_name = basename(Storage::url($filePath));
        $eCardInformation->image_url = Storage::url($filePath);
        $eCardInformation->save();

        $newUser = User::factory()->create();

        $response = $this
            ->actingAs($newUser)
            ->delete('/e-card/' .  $eCard->id);

        $response
            ->assertForbidden();
    }
}
