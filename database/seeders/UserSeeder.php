<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'ig_username' => 'https://www.instagram.com/ethann1325/',
                'name' => 'Ethan Wang',
                'photo_profile' => 'default.png',
                'gender' => 'male',
                'email' => 'ethan@gmail.com',
                'number' => '081235927829',
                'address' => 'Bandung Katulistiwa no 66',
                'balance' => 0,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'https://www.instagram.com/rafaelstevenn/',
                'name' => 'Steven',
                'photo_profile' => 'default.png',
                'gender' => 'male',
                'email' => 'steven@gmail.com',
                'number' => '081235927830',
                'address' => 'Malang Mantap Jiwa no 99',
                'balance' => 0,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'https://www.instagram.com/ti_nutuan/',
                'name' => 'Fernando Clemente',
                'photo_profile' => 'default.png',
                'gender' => 'male',
                'email' => 'nando@gmail.com',
                'number' => '081235927831',
                'address' => 'Manado nutuan 178',
                'balance' => 0,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
