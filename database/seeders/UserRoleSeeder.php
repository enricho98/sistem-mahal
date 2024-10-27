<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $userRoles = DB::table('user_roles')->get();

        foreach ($userRoles as $userRole) {
            $user = User::where('email', $userRole->email)->first();

            if ($user) {
                $role = Role::where('name', $userRole->role_name)->first();

                if ($role) {
                    $user->assignRole($role->name);
                } else {
                    \Log::error('Role tidak ditemukan untuk: ' . $userRole->role_name);
                }
            } else {
                \Log::error('Pengguna tidak ditemukan untuk: ' . $userRole->email);
            }
        }
    }
}
