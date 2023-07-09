<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();
        $timestamps = ['created_at' => $now, 'updated_at' => $now];
        foreach (Role::ROLES as $role => $name) {
            Role::factory()->create([
                'name' => $name,
            ]);
        }
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@user.com',
        ]);
        $adminUser->roles()->attach(Role::ADMIN, $timestamps);
        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
        ]);
        $user->roles()->attach(Role::USER, $timestamps);
        $apiUser = User::factory()->create([
            'name' => 'Api User',
            'email' => 'api@user.com',
        ]);
        $apiUser->roles()->attach(Role::API, $timestamps);
    }
}
