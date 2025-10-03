<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@dreamjar.net',
            'password' => bcrypt('Tek@Admin12')
        ]);
        
        // Check if the role already exists, if not, create it
        $role = Role::where('name', 'System Admin')->first();
        
        if (!$role) {
            $role = Role::create(['name' => 'System Admin', 'guard_name' => 'web']);
        }
        
        // Get all permissions
        $permissions = Permission::pluck('id', 'id')->all();
        
        // Sync permissions to the role
        $role->syncPermissions($permissions);
        
        // Assign role to the user
        $user->assignRole($role); // This is enough, no need to call assignRole twice
    }
}
