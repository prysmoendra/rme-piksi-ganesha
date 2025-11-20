<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nurse;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nurses = [
            [
                'nama_perawat' => 'Nurse Ratna Sari',
                'no_sipn' => 'SIPN-001-2024',
                'spesialisasi' => 'Medical-Surgical',
                'shift' => 'Pagi',
                'telepon' => '081234567900',
                'email' => 'ratna.sari@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_perawat' => 'Nurse Dewi Kusuma',
                'no_sipn' => 'SIPN-002-2024',
                'spesialisasi' => 'Pediatrics',
                'shift' => 'Siang',
                'telepon' => '081234567901',
                'email' => 'dewi.kusuma@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_perawat' => 'Nurse Agus Prasetyo',
                'no_sipn' => 'SIPN-003-2024',
                'spesialisasi' => 'ICU',
                'shift' => 'Malam',
                'telepon' => '081234567902',
                'email' => 'agus.prasetyo@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_perawat' => 'Nurse Lisa Indah',
                'no_sipn' => 'SIPN-004-2024',
                'spesialisasi' => 'Emergency',
                'shift' => 'Pagi',
                'telepon' => '081234567903',
                'email' => 'lisa.indah@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_perawat' => 'Nurse Rudi Hermawan',
                'no_sipn' => 'SIPN-005-2024',
                'spesialisasi' => 'Operating Room',
                'shift' => 'Siang',
                'telepon' => '081234567904',
                'email' => 'rudi.hermawan@piksi-ganesha.com',
                'is_active' => true,
            ],
        ];

        foreach ($nurses as $nurse) {
            Nurse::create($nurse);
        }
    }
}
