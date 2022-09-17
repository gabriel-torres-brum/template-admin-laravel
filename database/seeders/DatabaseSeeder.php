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
    public function run()
    {
        if (tenant()) {
            $this->call([
                UserSeeder::class,
                EcclesiasticalRoleSeeder::class,
                // PersonSeeder::class,
            ]);
        } else {
            $this->call([
                TenantSeeder::class,
                CentralUserSeeder::class
            ]);
        }
    }
}
