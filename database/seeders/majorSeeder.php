<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class majorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataMajors = [
            [
                'inisial_jurusan' => 'RPL',
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            ],
            [
                'inisial_jurusan' => 'TKJ',
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
            ],
        ];

        foreach($dataMajors as $dataMajor)
        {
            Competence::create($dataMajor);
        }
    }
}
