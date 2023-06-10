<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'projects-index', 'guard_name' => 'web'],
            ['name' => 'projects-show', 'guard_name' => 'web'],
            ['name' => 'projects-store', 'guard_name' => 'web'],
            ['name' => 'projects-update', 'guard_name' => 'web'],
            ['name' => 'projects-destroy', 'guard_name' => 'web'],

            ['name' => 'clients-index', 'guard_name' => 'web'],
            ['name' => 'clients-store', 'guard_name' => 'web'],
            ['name' => 'clients-update', 'guard_name' => 'web'],
            ['name' => 'clients-destroy', 'guard_name' => 'web'],
        ];

        Permission::insert($data);
    }
}
