<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' =>  tenant()->id . ' user',
            'email' => tenant()->id . '@email.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
