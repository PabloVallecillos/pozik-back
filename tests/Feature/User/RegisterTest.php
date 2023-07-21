<?php

namespace Tests\Feature\User;

use App\Mail\RegisterUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersCanRegisterUsingTheRegisterEndpoint(): void
    {
        $user = User::factory()->make();
        Mail::fake();
        $res = $this->post(route('user.register'), [
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'password' => bcrypt($user->password),
            'front_version' => $user->front_version,
            'platform' => $user->platform,
            'device' => $user->device,
            'locale' => $user->locale,
        ]);
        $res->assertOk();
        $res->assertJson([
            'user' => [
                'name' => $user->name
            ]
        ]);
        Mail::assertQueued(RegisterUser::class, function (RegisterUser $mail) use ($user) {
            return $mail->hasTo($user->email) &&
                $mail->assertSeeInHtml($user->name);
        });
    }
}
