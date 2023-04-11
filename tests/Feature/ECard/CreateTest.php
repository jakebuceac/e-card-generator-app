<?php

namespace Tests\Feature\ECard;

use App\Models\ECard;
use App\Models\ECardInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_and_edit_e_card(): void
    {
        $user = User::factory()
            ->has(
                ECard::factory()
                ->has(ECardInformation::factory())
            )->create();

        $response = $this
            ->actingAs($user)
            ->get('/e-card/' . $user->eCards()->first()->id);

        $response
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function test_users_see_404_if_no_e_card_id_given(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/e-card/' . 1);

        $response
            ->assertNotFound();
    }

    public function test_users_see_403_if_trying_to_access_an_e_card_not_made_by_them(): void
    {
        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();

        $newUser = User::factory()->create();

        $response = $this
            ->actingAs($newUser)
            ->get('/e-card/' . $user->eCards()->first()->id);

        $response
            ->assertForbidden();
    }

    public function test_edit_e_card_page_is_not_displayed_if_user_is_unauthenticated(): void
    {
        $user = User::factory()
            ->has(
                ECard::factory()
                    ->has(ECardInformation::factory())
            )->create();

        $response = $this
            ->get('/e-card/' . $user->eCards()->first()->id);

        $response->assertFound();
        $response->assertRedirect('/login');
    }
}
