<?php

namespace App\Permissions;

use App\Enums\PermissionEnum;

class RolePermissions
{
    public static function admin()
    {
        return [
            PermissionEnum::UserIndex->value,
            PermissionEnum::UserCreate->value,
            PermissionEnum::UserUpdate->value,
            PermissionEnum::UserDelete->value,
        ];
    }

    public static function security()
    {
        return [
            PermissionEnum::UserIndex->value,
        ];
    }

    public static function securityManager()
    {
        return [
            PermissionEnum::UserDelete->value,
        ];
    }
}
