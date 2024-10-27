<?php

namespace App\Enums;

enum PermissionEnum: string {
    case UserIndex = 'user.index';
    case UserCreate = 'user.create';
    case UserUpdate = 'user.update';
    case UserDelete = 'user.delete';
}
