<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Avatar::insert([
            [
                'image' => 'default.png',
                'price' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'gamer.png',
                'price' => 2000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'man_chill.png',
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'man_worker.png',
                'price' => 500,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'woman_ponytail.png',
                'price' => 300,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'women_child.png',
                'price' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'tiger.png',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'bull.png',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'dragon.png',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'anaconda.png',
                'price' => 30000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'cat.png',
                'price' => 52000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'duck.png',
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'horse.png',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'rabbit.png',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'snail.png',
                'price' => 25000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
