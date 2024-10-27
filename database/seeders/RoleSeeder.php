<?php

namespace Database\Seeders;

use App\Permissions\RolePermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// Assuming this class holds your role permissions

class RoleSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $this->assignPermissionsToRole($adminRole, RolePermissions::admin());

        $securityRole = Role::firstOrCreate(['name' => 'security']);
        $this->assignPermissionsToRole($securityRole, RolePermissions::security());

        $securityManagerRole = Role::firstOrCreate(['name' => 'security-manager']);
        $this->assignPermissionsToRole($securityManagerRole, RolePermissions::securityManager());
    }

    private function assignPermissionsToRole(Role $role, array $permissions)
    {
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        if (is_array($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            \Log::error("Permissions for role '{$role->name}' are not returning an array.");
        }
    }
}
