<?php

namespace Database\Seeders;

use App\Models\Yearsemester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class yearsemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datayearSemesters = [
            [
                'tahunAjar' => '2023/2024',
                'semester' => 'Ganjil',
            ],
            [
                'tahunAjar' => '2023/2024',
                'semester' => 'Genap',
            ],
        ];

        foreach($datayearSemesters as $datayearSemester)
        {
            Yearsemester::create($datayearSemester);
        }
    }
}
