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
                'ig_username' => 'cicil',
                'name' => 'Cicil',
                'photo_profile' => 'women_child.png',
                'gender' => 'Female',
                'email' => 'cil@gmail.com',
                'number' => '0812351227833',
                'address' => 'Malang mantap hehe',
                'balance' => 30000,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'ethann1325',
                'name' => 'Ethan Wang',
                'photo_profile' => 'dragon.png',
                'gender' => 'Male',
                'email' => 'ethan@gmail.com',
                'number' => '081235927829',
                'address' => 'Bandung Katulistiwa no 66',
                'balance' => 100,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'rafaelstevenn',
                'name' => 'Steven',
                'photo_profile' => 'bull.png',
                'gender' => 'Male',
                'email' => 'steven@gmail.com',
                'number' => '081235927830',
                'address' => 'Malang Mantap Jiwa no 99',
                'balance' => 200,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'michellepauline',
                'name' => 'Michelle Pauline',
                'photo_profile' => 'woman_ponytail.png',
                'gender' => 'Female',
                'email' => 'michelle@gmail.com',
                'number' => '081235927824',
                'address' => 'JABODETABEK',
                'balance' => 10000,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'ti_nutuan',
                'name' => 'Fernando Clemente',
                'photo_profile' => 'tiger.png',
                'gender' => 'Male',
                'email' => 'nando@gmail.com',
                'number' => '081235927831',
                'address' => 'Manado nutuan 178',
                'balance' => 300,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'pascalwilman',
                'name' => 'Pascal Wilman',
                'photo_profile' => 'gamer.png',
                'gender' => 'Male',
                'email' => 'pascal@gmail.com',
                'number' => '081235927851',
                'address' => 'BOGOR MANTAP',
                'balance' => 10000,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'lusia',
                'name' => 'Lusia',
                'photo_profile' => 'tiger.png',
                'gender' => 'Female',
                'email' => 'lus@gmail.com',
                'number' => '081235927833',
                'address' => 'Jlaan apa aja no1',
                'balance' => 20000,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ig_username' => 'exy',
                'name' => 'Exaudina',
                'photo_profile' => 'bull.png',
                'gender' => 'Female',
                'email' => 'exy@gmail.com',
                'number' => '0812351227823',
                'address' => 'Gatau dimana aja',
                'balance' => 30000,
                'hidden' => false,
                'password' => Hash::make('test123'),
                'is_paying' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
