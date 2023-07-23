<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoggedTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteLogged(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $this
            ->get(route('user.logged'))
            ->assertOk();
    }

    public function testRouteLoggedWithUnAuth(): void
    {
        $this
            ->get(route('user.logged'))
            ->assertServerError();
    }
}
