<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions related to only user itself (Not friend/follower)
        Permission::create(['name' => 'send request']);
        Permission::create(['name' => 'view profile']);
        Permission::create(['name' => 'write post']);
        Permission::create(['name' => 'write comment']);

        // create roles and assign existing permissions
        $roleUser = Role::create(['name' => 'User']);
        $roleUser->givePermissionTo(['send request', 'view profile', 'write post', 'write comment']);

        $roleAdmin = Role::create(['name' => 'Admin']);

        // create users
        $user = \App\Models\User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@social.com',
        ]);
        $user->assignRole($roleUser);

        $user = \App\Models\User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@social.com',
        ]);
        $user->assignRole($roleUser);

        $user = \App\Models\User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@social.com',
        ]);
        $user->assignRole($roleUser);

        $user = \App\Models\User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@social.com',
        ]);
        $user->assignRole($roleUser);

        $user = \App\Models\User::factory()->create([
            'name' => 'user5',
            'email' => 'user5@social.com',
        ]);
        $user->assignRole($roleUser);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);
        $user->assignRole($roleAdmin);
    }
}
