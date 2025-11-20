<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Icd10Code;

class Icd10CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icd10Codes = [
            // Infectious and parasitic diseases
            ['code' => 'A00.0', 'description' => 'Cholera due to Vibrio cholerae 01, biovar cholerae', 'category' => 'Infectious diseases', 'is_active' => true],
            ['code' => 'A00.1', 'description' => 'Cholera due to Vibrio cholerae 01, biovar eltor', 'category' => 'Infectious diseases', 'is_active' => true],
            ['code' => 'A01.0', 'description' => 'Typhoid fever', 'category' => 'Infectious diseases', 'is_active' => true],
            ['code' => 'A01.1', 'description' => 'Paratyphoid fever A', 'category' => 'Infectious diseases', 'is_active' => true],
            
            // Neoplasms
            ['code' => 'C00.0', 'description' => 'Malignant neoplasm of external upper lip', 'category' => 'Neoplasms', 'is_active' => true],
            ['code' => 'C00.1', 'description' => 'Malignant neoplasm of external lower lip', 'category' => 'Neoplasms', 'is_active' => true],
            ['code' => 'C15.9', 'description' => 'Malignant neoplasm of esophagus, unspecified', 'category' => 'Neoplasms', 'is_active' => true],
            ['code' => 'C16.9', 'description' => 'Malignant neoplasm of stomach, unspecified', 'category' => 'Neoplasms', 'is_active' => true],
            
            // Diseases of the circulatory system
            ['code' => 'I10', 'description' => 'Essential hypertension', 'category' => 'Circulatory system', 'is_active' => true],
            ['code' => 'I11.9', 'description' => 'Hypertensive heart disease without heart failure', 'category' => 'Circulatory system', 'is_active' => true],
            ['code' => 'I20.9', 'description' => 'Angina pectoris, unspecified', 'category' => 'Circulatory system', 'is_active' => true],
            ['code' => 'I21.9', 'description' => 'Acute myocardial infarction, unspecified', 'category' => 'Circulatory system', 'is_active' => true],
            
            // Diseases of the respiratory system
            ['code' => 'J06.9', 'description' => 'Acute upper respiratory infection, unspecified', 'category' => 'Respiratory system', 'is_active' => true],
            ['code' => 'J18.9', 'description' => 'Pneumonia, unspecified organism', 'category' => 'Respiratory system', 'is_active' => true],
            ['code' => 'J44.1', 'description' => 'Chronic obstructive pulmonary disease with acute exacerbation', 'category' => 'Respiratory system', 'is_active' => true],
            ['code' => 'J45.9', 'description' => 'Asthma, unspecified', 'category' => 'Respiratory system', 'is_active' => true],
            
            // Diseases of the digestive system
            ['code' => 'K25.9', 'description' => 'Gastric ulcer, unspecified as acute or chronic, without hemorrhage or perforation', 'category' => 'Digestive system', 'is_active' => true],
            ['code' => 'K26.9', 'description' => 'Duodenal ulcer, unspecified as acute or chronic, without hemorrhage or perforation', 'category' => 'Digestive system', 'is_active' => true],
            ['code' => 'K29.7', 'description' => 'Gastritis, unspecified', 'category' => 'Digestive system', 'is_active' => true],
            ['code' => 'K59.0', 'description' => 'Constipation', 'category' => 'Digestive system', 'is_active' => true],
            
            // Diseases of the musculoskeletal system
            ['code' => 'M79.3', 'description' => 'Panniculitis, unspecified', 'category' => 'Musculoskeletal system', 'is_active' => true],
            ['code' => 'M79.6', 'description' => 'Pain in limb, hand, foot, fingers and toes', 'category' => 'Musculoskeletal system', 'is_active' => true],
            ['code' => 'M79.9', 'description' => 'Soft tissue disorder, unspecified', 'category' => 'Musculoskeletal system', 'is_active' => true],
            
            // Injury, poisoning and certain other consequences of external causes
            ['code' => 'S00.0', 'description' => 'Superficial injury of scalp', 'category' => 'Injury', 'is_active' => true],
            ['code' => 'S01.9', 'description' => 'Open wound of head, unspecified', 'category' => 'Injury', 'is_active' => true],
            ['code' => 'S72.0', 'description' => 'Fracture of neck of femur', 'category' => 'Injury', 'is_active' => true],
            ['code' => 'T78.4', 'description' => 'Allergy, unspecified', 'category' => 'Injury', 'is_active' => true],
            
            // Factors influencing health status and contact with health services
            ['code' => 'Z00.0', 'description' => 'Encounter for general adult medical examination without abnormal findings', 'category' => 'Health services', 'is_active' => true],
            ['code' => 'Z00.1', 'description' => 'Encounter for newborn, infant and child health examination', 'category' => 'Health services', 'is_active' => true],
            ['code' => 'Z51.1', 'description' => 'Antineoplastic chemotherapy', 'category' => 'Health services', 'is_active' => true],
            ['code' => 'Z51.11', 'description' => 'Antineoplastic chemotherapy', 'category' => 'Health services', 'is_active' => true],
            
            // New entries for Diabetes Mellitus
            ['code' => 'E11.9', 'description' => 'Type 2 diabetes mellitus without complications', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
            ['code' => 'E11.65', 'description' => 'Type 2 diabetes mellitus with hyperglycemia', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
            ['code' => 'E11.21', 'description' => 'Type 2 diabetes mellitus with diabetic nephropathy', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
            ['code' => 'E11.40', 'description' => 'Type 2 diabetes mellitus with neurological complications, unspecified', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
            ['code' => 'E11.51', 'description' => 'Type 2 diabetes mellitus with peripheral angiopathy', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
            ['code' => 'E11.621', 'description' => 'Type 2 diabetes mellitus with foot ulcer', 'category' => 'Endocrine (Diabetes)', 'is_active' => true],
        ];

        foreach ($icd10Codes as $code) {
            Icd10Code::create($code);
        }
    }
}
