<?php

namespace Database\Seeders;

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
        $this->call([
            AvatarSeeder::class,
            HobbySeeder::class,
            UserSeeder::class,
            CollectionSeeder::class,
            ChatSeeder::class,
            WishlistSeeder::class,
            HeaderHobbySeeder::class,
        ]);
    }
}
