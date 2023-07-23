<?php

namespace Tests\Feature\User;

use App\Mail\User\RecoveryPasswordUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RecoveryPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteRecoveryPassword(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        Mail::fake();
        $res = $this->get(route('user.recovery-password'));
        $res->assertOk();
        $res->assertJson(['status' => true]);
        Mail::assertQueued(RecoveryPasswordUser::class, function (RecoveryPasswordUser $mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
