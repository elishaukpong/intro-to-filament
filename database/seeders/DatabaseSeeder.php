<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Conference;
use App\Models\Speaker;
use App\Models\Talk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        Venue::factory()->count(200)->create();
        Speaker::factory()->count(20)->withTalks(4)->create();
        Attendee::factory()
            ->count(20)
            ->forConference(Conference::factory()->create())
            ->create();
    }
}
