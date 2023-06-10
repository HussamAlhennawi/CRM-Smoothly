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
            ['name' => 'projects-index'],
            ['name' => 'projects-show'],
            ['name' => 'projects-store'],
            ['name' => 'projects-update'],
            ['name' => 'projects-destroy'],

            ['name' => 'clients-index'],
            ['name' => 'clients-store'],
            ['name' => 'clients-update'],
            ['name' => 'clients-destroy'],
        ];

        Permission::insert($data);
    }
}
