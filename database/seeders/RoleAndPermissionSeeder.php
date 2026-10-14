<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();  


         $permissions = [
            'view inventory',
            'create inventory',
            'edit inventory',
            'delete inventory'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 
            'guard_name' => 'web']);
        }

// crear roles
        $role1 = Role::create (['name' => 'Admin']);
        $role1->givePermissionTo([
            'view inventory',
            'create inventory',
            'edit inventory',
            'delete inventory'
        ]);


        $role2 = Role::create (['name' => 'Empleado']);
        $role2->givePermissionTo([
        'view inventory'
        ]);

        

    }
}
