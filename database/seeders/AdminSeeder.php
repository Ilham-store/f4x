<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

                // Reset permission cache
                app()[PermissionRegistrar::class]->forgetCachedPermissions();

                // Buat role admin (pastikan guard sama)
                $role_admin = Role::firstOrCreate([
                    'name' => 'admin',
                    'guard_name' => 'web', // penting!
                ]);
        
                // Buat user admin
                $user_admin = User::firstOrCreate(
                    ['email' => 'admin@gmail.com'],
                    [
                        'name' => 'Super Admin',
                        'password' => Hash::make('admin'),
                    ]
                );

                $role_staf = Role::firstOrCreate([
                    'name' => 'staf',
                    'guard_name' => 'web', // penting!
                ]);
                
                $user_staf = User::firstOrCreate(
                    ['email' => 'staf@gmail.com'],
                    [
                        'name' => 'Staf',
                        'password' => Hash::make('staf'),
                    ]
                );

                // Assign role
                $user_admin->syncRoles([$role_admin]);
                $user_staf->syncRoles([$role_staf]);
    }
}
