<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Mail\RegisterUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function user(Request $request): array
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
}
