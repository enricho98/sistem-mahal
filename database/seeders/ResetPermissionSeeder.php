<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResetPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
