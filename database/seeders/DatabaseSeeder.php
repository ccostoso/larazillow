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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => 1,
        ])->has(\App\Models\Listing::factory(10))->create();

        \App\Models\User::factory([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ])->has(\App\Models\Listing::factory(10))->create();

        // \App\Models\Listing::factory(10)->create();
    }
}
