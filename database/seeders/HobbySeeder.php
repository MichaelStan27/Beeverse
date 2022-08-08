<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobby::insert([
            [
                'activity' => 'Badminton',
                'image' => 'badminton.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Soccer',
                'image' => 'soccer.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Swimming',
                'image' => 'swimming.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Golf',
                'image' => 'golf.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'PingPong',
                'image' => 'pingpong.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
