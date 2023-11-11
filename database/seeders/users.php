<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            DB::table('users')->insert([
                [
                    'user' => 'test1',
                    'password' => '$2y$10$eSePpwz2hteTQZNXO1BvFeI.VCSGF/YqGdpZda/sHQDQWzAJoehYi',
                    'family_name' => 'テスト',
                    'first_name' => '花子'
                ],

                [
                    'user' => 'test2',
                    'password' => '$2y$10$btIzYtozzeEJ2J53ZU/Qz.YBK61RilXtGcVJkrZfz1r/fS8R72F.i',
                    'family_name' => 'テスト',
                    'first_name' => '太郎'
                ]
            ]);
        }
    }
}
