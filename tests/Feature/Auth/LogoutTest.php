<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteLogoutInvalidatesToken()
    {
        $user = User::factory()->create();

        $token = $user->createToken($user->device)->plainTextToken;

        $res = $this
            ->withHeader('Authorization', "Bearer $token")
            ->get(route('token.logout'));

        $res->assertOk();

        self::assertCount(0, $user->tokens);
    }
}
