<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            // 'guard_name' => 'admin',
            'name' => 'Admin'
        ]);
        $freelancer = Role::create([
            // 'guard_name' => 'freelancer',
            'name' => 'Freelancer'
        ]);
        $contractor = Role::create([
            // 'guard_name' => 'contractor',
            'name' => 'Contractor'
        ]);
        $journalist = Role::create([
            // 'guard_name' => 'journalist',
            'name' => 'Journalist'
        ]);

        $permission = Permission::create([
            // 'guard_name' => 'admin',
            'name' => 'users'
        ]);
    }
}
