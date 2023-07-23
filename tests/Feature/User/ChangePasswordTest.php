<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteChangePassword(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $newPwd = 'new-password';
        $res = $this->put(route('user.change-password'), [
            'old_password' => 'password',
            'new_password' => $newPwd,
            'copy_new_password' => $newPwd,
        ]);
        $res->assertOk();
        $res->assertJson(['status' => true]);
        $this->assertTrue(Hash::check($newPwd, $user->password));
    }
}
