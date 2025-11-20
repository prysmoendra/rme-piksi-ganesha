<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MedicationFormulary;

class MedicationFormularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medications = [
            // Analgesics
            [
                'nama_obat' => 'Paracetamol',
                'kode_obat' => 'PAR001',
                'deskripsi' => 'Pain reliever and fever reducer',
                'satuan' => '500mg tablet',
                'kategori' => 'Analgesic',
                'indikasi' => 'Pain relief, fever reduction',
                'kontraindikasi' => 'Severe liver disease',
                'harga' => 500.00,
                'is_active' => true,
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'kode_obat' => 'IBU001',
                'deskripsi' => 'Nonsteroidal anti-inflammatory drug',
                'satuan' => '400mg tablet',
                'kategori' => 'Analgesic',
                'indikasi' => 'Pain relief, inflammation reduction',
                'kontraindikasi' => 'Peptic ulcer, severe heart failure',
                'harga' => 750.00,
                'is_active' => true,
            ],
            
            // Antibiotics
            [
                'nama_obat' => 'Amoxicillin',
                'kode_obat' => 'AMO001',
                'deskripsi' => 'Penicillin antibiotic',
                'satuan' => '500mg capsule',
                'kategori' => 'Antibiotic',
                'indikasi' => 'Bacterial infections',
                'kontraindikasi' => 'Penicillin allergy',
                'harga' => 1200.00,
                'is_active' => true,
            ],
            [
                'nama_obat' => 'Cefixime',
                'kode_obat' => 'CEF001',
                'deskripsi' => 'Third generation cephalosporin',
                'satuan' => '200mg capsule',
                'kategori' => 'Antibiotic',
                'indikasi' => 'Respiratory and urinary tract infections',
                'kontraindikasi' => 'Cephalosporin allergy',
                'harga' => 1500.00,
                'is_active' => true,
            ],
            
            // Antihypertensives
            [
                'nama_obat' => 'Amlodipine',
                'kode_obat' => 'AML001',
                'deskripsi' => 'Calcium channel blocker',
                'satuan' => '5mg tablet',
                'kategori' => 'Antihypertensive',
                'indikasi' => 'Hypertension, angina',
                'kontraindikasi' => 'Severe hypotension',
                'harga' => 800.00,
                'is_active' => true,
            ],
            [
                'nama_obat' => 'Losartan',
                'kode_obat' => 'LOS001',
                'deskripsi' => 'Angiotensin receptor blocker',
                'satuan' => '50mg tablet',
                'kategori' => 'Antihypertensive',
                'indikasi' => 'Hypertension, diabetic nephropathy',
                'kontraindikasi' => 'Pregnancy, severe liver disease',
                'harga' => 1000.00,
                'is_active' => true,
            ],
            
            // Antidiabetics
            [
                'nama_obat' => 'Metformin',
                'kode_obat' => 'MET001',
                'deskripsi' => 'Biguanide antidiabetic',
                'satuan' => '500mg tablet',
                'kategori' => 'Antidiabetic',
                'indikasi' => 'Type 2 diabetes mellitus',
                'kontraindikasi' => 'Severe kidney disease, liver disease',
                'harga' => 600.00,
                'is_active' => true,
            ],
            [
                'nama_obat' => 'Gliclazide',
                'kode_obat' => 'GLI001',
                'deskripsi' => 'Sulfonylurea antidiabetic',
                'satuan' => '80mg tablet',
                'kategori' => 'Antidiabetic',
                'indikasi' => 'Type 2 diabetes mellitus',
                'kontraindikasi' => 'Type 1 diabetes, severe kidney disease',
                'harga' => 700.00,
                'is_active' => true,
            ],
            
            // Gastrointestinal
            [
                'nama_obat' => 'Omeprazole',
                'kode_obat' => 'OME001',
                'deskripsi' => 'Proton pump inhibitor',
                'satuan' => '20mg capsule',
                'kategori' => 'Gastrointestinal',
                'indikasi' => 'Gastric ulcer, GERD',
                'kontraindikasi' => 'Hypersensitivity to omeprazole',
                'harga' => 900.00,
                'is_active' => true,
            ],
            [
                'nama_obat' => 'Domperidone',
                'kode_obat' => 'DOM001',
                'deskripsi' => 'Dopamine antagonist',
                'satuan' => '10mg tablet',
                'kategori' => 'Gastrointestinal',
                'indikasi' => 'Nausea, vomiting, gastroparesis',
                'kontraindikasi' => 'Gastrointestinal hemorrhage',
                'harga' => 650.00,
                'is_active' => true,
            ],
        ];

        foreach ($medications as $medication) {
            MedicationFormulary::create($medication);
        }
    }
}
