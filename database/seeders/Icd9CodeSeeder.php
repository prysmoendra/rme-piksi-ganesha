<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Icd9Code;

class Icd9CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icd9Codes = [
            // Procedures
            ['code' => '001.1', 'description' => 'Biopsy of skin', 'category' => 'Biopsy', 'is_active' => true],
            ['code' => '001.2', 'description' => 'Biopsy of subcutaneous tissue', 'category' => 'Biopsy', 'is_active' => true],
            ['code' => '001.3', 'description' => 'Biopsy of muscle', 'category' => 'Biopsy', 'is_active' => true],
            ['code' => '001.4', 'description' => 'Biopsy of bone', 'category' => 'Biopsy', 'is_active' => true],
            
            // Surgical procedures
            ['code' => '001.5', 'description' => 'Incision and drainage of abscess', 'category' => 'Surgery', 'is_active' => true],
            ['code' => '001.6', 'description' => 'Excision of lesion of skin', 'category' => 'Surgery', 'is_active' => true],
            ['code' => '001.7', 'description' => 'Excision of subcutaneous tissue', 'category' => 'Surgery', 'is_active' => true],
            ['code' => '001.8', 'description' => 'Excision of muscle', 'category' => 'Surgery', 'is_active' => true],
            
            // Diagnostic procedures
            ['code' => '001.9', 'description' => 'Other diagnostic procedures', 'category' => 'Diagnostic', 'is_active' => true],
            ['code' => '002.0', 'description' => 'Blood test', 'category' => 'Diagnostic', 'is_active' => true],
            ['code' => '002.1', 'description' => 'Urine test', 'category' => 'Diagnostic', 'is_active' => true],
            ['code' => '002.2', 'description' => 'Stool test', 'category' => 'Diagnostic', 'is_active' => true],
            
            // Imaging procedures
            ['code' => '002.3', 'description' => 'X-ray examination', 'category' => 'Imaging', 'is_active' => true],
            ['code' => '002.4', 'description' => 'CT scan', 'category' => 'Imaging', 'is_active' => true],
            ['code' => '002.5', 'description' => 'MRI examination', 'category' => 'Imaging', 'is_active' => true],
            ['code' => '002.6', 'description' => 'Ultrasound examination', 'category' => 'Imaging', 'is_active' => true],
            
            // Endoscopic procedures
            ['code' => '002.7', 'description' => 'Endoscopy of upper gastrointestinal tract', 'category' => 'Endoscopy', 'is_active' => true],
            ['code' => '002.8', 'description' => 'Colonoscopy', 'category' => 'Endoscopy', 'is_active' => true],
            ['code' => '002.9', 'description' => 'Other endoscopic procedures', 'category' => 'Endoscopy', 'is_active' => true],
            
            // Therapeutic procedures
            ['code' => '003.0', 'description' => 'Physical therapy', 'category' => 'Therapy', 'is_active' => true],
            ['code' => '003.1', 'description' => 'Occupational therapy', 'category' => 'Therapy', 'is_active' => true],
            ['code' => '003.2', 'description' => 'Speech therapy', 'category' => 'Therapy', 'is_active' => true],
            ['code' => '003.3', 'description' => 'Respiratory therapy', 'category' => 'Therapy', 'is_active' => true],
            
            // Diabetes-Related Procedures
            ['code' => '99.10', 'description' => 'Injection or infusion of insulin', 'category' => 'Therapy/Infusion', 'is_active' => true],
            ['code' => '99.15', 'description' => 'Parenteral infusion of concentrated nutritional substances', 'category' => 'Therapy/Infusion', 'is_active' => true],
            ['code' => '93.39', 'description' => 'Physical therapy for diabetic neuropathy', 'category' => 'Therapy', 'is_active' => true],
            ['code' => '99.29', 'description' => 'Injection or infusion of other therapeutic or prophylactic substance', 'category' => 'Therapy/Infusion', 'is_active' => true],
        ];

        foreach ($icd9Codes as $code) {
            Icd9Code::create($code);
        }
    }
}
