<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user =  User::factory(10)->create();

        Ticket::factory(100)
            ->recycle($user)
            ->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'email' => 'manager@abc.com',
            'password' => bcrypt('password'),
            'name' => "Manager",
            'is_manager' => true
        ]);
    }
}
