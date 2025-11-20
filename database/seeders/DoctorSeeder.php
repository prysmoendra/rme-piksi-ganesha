<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'nama_dokter' => 'Dr. Ahmad Wijaya',
                'spesialisasi' => 'Internal Medicine',
                'no_sip' => 'SIP-001-2024',
                'alamat_praktik' => 'Jl. Kesehatan No. 1, Jakarta',
                'telepon' => '081234567890',
                'email' => 'ahmad.wijaya@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_dokter' => 'Dr. Siti Rahayu',
                'spesialisasi' => 'Pediatrics',
                'no_sip' => 'SIP-002-2024',
                'alamat_praktik' => 'Jl. Anak Sehat No. 2, Jakarta',
                'telepon' => '081234567891',
                'email' => 'siti.rahayu@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_dokter' => 'Dr. Budi Santoso',
                'spesialisasi' => 'Surgery',
                'no_sip' => 'SIP-003-2024',
                'alamat_praktik' => 'Jl. Bedah No. 3, Jakarta',
                'telepon' => '081234567892',
                'email' => 'budi.santoso@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_dokter' => 'Dr. Maria Magdalena',
                'spesialisasi' => 'Obstetrics & Gynecology',
                'no_sip' => 'SIP-004-2024',
                'alamat_praktik' => 'Jl. Wanita Sehat No. 4, Jakarta',
                'telepon' => '081234567893',
                'email' => 'maria.magdalena@piksi-ganesha.com',
                'is_active' => true,
            ],
            [
                'nama_dokter' => 'Dr. John Smith',
                'spesialisasi' => 'Cardiology',
                'no_sip' => 'SIP-005-2024',
                'alamat_praktik' => 'Jl. Jantung Sehat No. 5, Jakarta',
                'telepon' => '081234567894',
                'email' => 'john.smith@piksi-ganesha.com',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
