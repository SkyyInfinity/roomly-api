<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        User::factory(20)->create();
        DB::table('rooms')->truncate();
        Room::factory(20)->create();
        DB::table('reservations')->truncate();
        Reservation::factory(10)->create();
    }
}
