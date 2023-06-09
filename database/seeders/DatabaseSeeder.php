<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            ClientSeeder::class,
            ProjectSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
