<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Tickets;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TicketsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        Ticket::factory(100)
            ->recycle($users)
            ->create();

        User::factory()->create([
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password'),
            'name' => 'The manager',
            'is_manager' => true,
        ]);
    }
}
