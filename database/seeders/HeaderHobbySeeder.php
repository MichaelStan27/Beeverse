<?php

namespace Database\Seeders;

use App\Models\HeaderHobby;
use Illuminate\Database\Seeder;

class HeaderHobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeaderHobby::insert([
            [
                'user_id' => 1,
                'hobby_id' => 1,
            ],
            [
                'user_id' => 1,
                'hobby_id' => 2,
            ],
            [
                'user_id' => 1,
                'hobby_id' => 5,
            ],
            [
                'user_id' => 2,
                'hobby_id' => 2,
            ],
            [
                'user_id' => 2,
                'hobby_id' => 4,
            ],
            [
                'user_id' => 2,
                'hobby_id' => 5,
            ],
            [
                'user_id' => 3,
                'hobby_id' => 3,
            ],
            [
                'user_id' => 3,
                'hobby_id' => 4,
            ],
            [
                'user_id' => 3,
                'hobby_id' => 5,
            ],
        ]);
    }
}
