<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class mapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataMapels = [
            [
                'codeMapel' => 'MTK',
                'namaMapel' => 'Matematika',
            ],
        ];

        foreach($dataMapels as $dataMapel)
        {
            Subject::create($dataMapel);
        }
    }
}
