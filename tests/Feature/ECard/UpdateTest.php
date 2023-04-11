<?php

namespace Tests\Feature\ECard;

use App\Enum\ECardSizeEnum;
use App\Models\ECard;
use App\Models\ECardInformation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    public function test_e_card_information_gets_updated(): void
    {
        Storage::fake('spaces');

        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();

        $usersECard = $user->eCards()->first();

        $eCardInformation = ECardInformation::factory()->create();

        $base64 = base64_encode(file_get_contents(base_path('tests/Stubs/Test_256x256.png')));

        $response = $this
            ->actingAs($user)
            ->put('/e-card/' .  $usersECard->id, [
                'design_state' => $eCardInformation->assets,
                'image_base_64' => $base64,
                'filename' => 'Test2.png',
                'size' => ECardSizeEnum::LARGE->value,
            ]);

        $response
            ->assertOk()
            ->assertSessionHasNoErrors();

        $usersECard->refresh();

        $this->assertDatabaseHas('e_cards', [
            'id' => $usersECard->id,
            'user_id' => $user->id,
            'name' => basename($usersECard->name),
            'thumbnail_url' => $usersECard->thumbnail_url,
            'size' => ECardSizeEnum::LARGE->value,
            'occasion' => $usersECard->occasion,
        ]);

        $this->assertDatabaseHas('e_card_information', [
            'e_card_id' => $usersECard->id,
            'image_url' => $usersECard->eCardInformation->image_url,
        ]);
    }

    public function test_e_card_is_stored_on_spaces(): void
    {
        Storage::fake('spaces');

        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();

        $usersECard = $user->eCards()->first();

        $eCardInformation = ECardInformation::factory()->create();

        $base64 = base64_encode(file_get_contents(base_path('tests/Stubs/Test_256x256.png')));

        $response = $this
            ->actingAs($user)
            ->put('/e-card/' .  $usersECard->id, [
                'design_state' => $eCardInformation->assets,
                'image_base_64' => $base64,
                'filename' => 'Test2.png',
                'size' => ECardSizeEnum::SMALL->value,
            ]);

        $response
            ->assertOk()
            ->assertSessionHasNoErrors();

        $eCardsPath = '/' . $user->id . '/e-cards/';
        $thumbnailsPath = '/' . $user->id . '/e-cards/thumbnails/';

        $this->assertTrue(Storage::exists($eCardsPath));
        $this->assertTrue(Storage::exists($thumbnailsPath));

        $this->assertTrue(count(Storage::allFiles($eCardsPath)) === 1);
        $this->assertTrue(count(Storage::allFiles($thumbnailsPath)) === 1);
    }

    public function test_users_see_403_when_trying_to_update_an_e_card_not_made_by_them(): void
    {
        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();
        $usersECard = $user->eCards()->first();

        $newUser = User::factory()->create();

        $eCardInformation = ECardInformation::factory()->create();

        $base64 = base64_encode(file_get_contents(base_path('tests/Stubs/Test_256x256.png')));

        $response = $this
            ->actingAs($newUser)
            ->put('/e-card/' .  $usersECard->id, [
                'design_state' => $eCardInformation->assets,
                'image_base_64' => $base64,
                'filename' => 'Test2.png',
                'size' => ECardSizeEnum::SMALL->value,
            ]);

        $response
            ->assertForbidden();
    }
}
