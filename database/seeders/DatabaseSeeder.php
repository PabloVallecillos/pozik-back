<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $apiUser = User::factory()->create([
            'name' => 'api',
            'email' => 'api@api.api',
            'password' => bcrypt(config('pozik.api_user_password')),
            'surname' => "api",
            'locale' => config('app.locale'),
            'platform' => "api",
            'device' => "api",
            'auth_provider' => "api",
        ]);
        foreach (Role::ROLES as $role) {
            Role::factory()->create([
                'name' => $role,
            ]);
        }
        $apiUser->roles()->attach(Role::API, ['created_at' => now(), 'updated_at' => now()]);
    }
}
