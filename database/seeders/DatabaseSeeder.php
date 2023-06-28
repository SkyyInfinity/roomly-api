<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Favorite;
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
        DB::table('favorites')->truncate();
        DB::table('favorites')->insert([
            ['user_id' => 21, 'room_id' => 1, 'created_at' => now()],
            ['user_id' => 21, 'room_id' => 20, 'created_at' => now()],
            ['user_id' => 5, 'room_id' => 3, 'created_at' => now()],
            ['user_id' => 21, 'room_id' => 17, 'created_at' => now()],
            ['user_id' => 17, 'room_id' => 5, 'created_at' => now()],
        ]);
    }
}
