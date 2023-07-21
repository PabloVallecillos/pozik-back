<?php

namespace Tests\Feature\User;

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
            ->get(route('user.logout'));

        $res->assertOk();

        self::assertCount(0, $user->tokens);
    }
}
