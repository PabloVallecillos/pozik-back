<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Mail\User\RecoveryPasswordUser;
use App\Mail\User\RegisterUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @unauthenticated
     */
    public function login(LoginUserRequest $request): array
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        return [
            'token' => $user->createToken($request->device ?? $user->id)->plainTextToken,
            'user' => $user,
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function logged(Request $request): array
    {
        return [
            'user' => $request->user()
        ];
    }

    /**
     * @unauthenticated
     */
    public function register(RegisterUserRequest $request): array
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'front_version' => $request->front_version,
            'platform' => $request->platform,
            'device' => $request->device,
            'auth_provider' => User::API_AUTH_PROVIDER,
        ]);
        Mail::to($user->email)->send(new RegisterUser($user));

        return [
            'user' => $user
        ];
    }

    public function recoveryPassword(Request $request): array
    {
        $user = $request->user();
        $passwordRecovered = Str::random(10);
        $user->password = bcrypt($passwordRecovered);
        $status = $user->save();
        Mail::to($user->email)->send(new RecoveryPasswordUser($user, $passwordRecovered));

        return [
            'status' => $status,
        ];
    }

    public function changePassword(ChangePasswordUserRequest $request): array
    {
        $user = $request->user();
        $user->password = bcrypt($request->new_password);

        return [
            'status' => $user->save(),
        ];
    }
}
