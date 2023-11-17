<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataUsers = [
            [
                'username' => 'admin',
                'role' => '0',
                'password' => bcrypt('admin'),
            ],
            [
                'username' => 'guruPiket',
                'role' => '2',
                'password' => bcrypt('guruPiket'),

            ],
            [
                'username' => 'kreator',
                'role' => '3',
                'password' => bcrypt('kreator'),

            ],
        ];

        foreach($dataUsers as $dataUser)
        {
            User::create($dataUser);
        }
    }
}
