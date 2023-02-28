<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Configuration;
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
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'aswarkasim',
            'email' => 'aswarkasim@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'riski',
            'email' => 'riski@gmail.com',
            'role' => 'user',
            'password' => bcrypt('password')
        ]);

        Configuration::create([
            'app_name' => 'KTC FW'
        ]);
    }
}
