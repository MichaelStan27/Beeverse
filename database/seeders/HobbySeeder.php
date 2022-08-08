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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Soccer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Swimming',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'Golf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity' => 'PingPong',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
