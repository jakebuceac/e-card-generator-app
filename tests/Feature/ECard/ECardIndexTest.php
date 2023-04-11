<?php

namespace Tests\Feature\ECard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ECardIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_the_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response
            ->assertOk()
            ->assertSessionHasNoErrors();
    }

    public function test_users_cannot_see_dashboard_if_unauthenticated(): void
    {
        $response = $this
            ->get('/dashboard');

        $response->assertFound();
        $response->assertRedirect('/login');
    }
}
