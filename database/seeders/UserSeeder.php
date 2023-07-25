<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
            // Create permissions
           $create= Permission::create(['name' => 'create posts' ,'guard_name' => 'api' ]);
           $edit = Permission::create(['name' => 'edit posts' ,'guard_name' => 'api']);
            
    
           //Create roles and assign permissions
            $adminRole = Role::create(['name' => 'admin','guard_name' => 'api']);
            $adminRole->givePermissionTo([ $create, $edit]);
    
            $editorRole = Role::create(['name' => 'user','guard_name' => 'api' ]);
            $editorRole->givePermissionTo([ $edit]);

            $user = User::find(1);

            // Assign role to user
            $role = Role::findByName('admin', 'api');
            $user->assignRole($role);
            
            // Assign permission to user
            $permission = Permission::findByName('create posts','api'  );
            $user->givePermissionTo($permission);

        
    }
}
