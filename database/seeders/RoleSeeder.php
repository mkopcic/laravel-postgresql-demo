<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole  = Role::firstOrCreate(['name' => 'user']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Administrator', 'password' => bcrypt('password')]
        );
        $admin->syncRoles([$adminRole]);

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Test Korisnik', 'password' => bcrypt('password')]
        );
        $user->syncRoles([$userRole]);
    }
}
