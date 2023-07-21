<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersCanAuthenticateUsingTheLoginEndpoint(): void
    {
        $user = User::factory()->create();

        $this
            ->post(route('user.login'), [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertOk();
    }

    public function testUsersCanNotAuthenticateWithInvalidPasswordUsingTheLoginEndpoint(): void
    {
        $user = User::factory()->create();

        $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
