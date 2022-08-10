<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::insert([
            [
                'user_id' => 1,
                'user_id_sent' => 2,
                'avatar_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'user_id_sent' => 5,
                'avatar_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'user_id_sent' => 8,
                'avatar_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'user_id_sent' => 4,
                'avatar_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'user_id_sent' => 8,
                'avatar_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'user_id_sent' => 1,
                'avatar_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'user_id_sent' => 7,
                'avatar_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'user_id_sent' => 3,
                'avatar_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'user_id_sent' => 4,
                'avatar_id' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
