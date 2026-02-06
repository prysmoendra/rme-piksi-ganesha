<?php

namespace App\Patterns\Structural\Facade;

use App\Patterns\Creational\Builder\AdmissionBuilder;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\InpatientAdmission;

class AdmissionFacade
{
    public function registerPatient(array $data): InpatientAdmission
    {
        return DB::transaction(function () use ($data) {
            // 1. Find or Create Patient
            // Simplified logic for example; normally would check existing NIK/RM
            $patient = Patient::firstOrCreate(
                ['id_rekam_medis' => $data['id_rekam_medis']],
                ['nama_lengkap' => $data['nama_lengkap']]
            );
            
            // 2. Build Admission using Builder Pattern
            $builder = new AdmissionBuilder();
            
            $admission = $builder->setPatient($patient)
                                 ->setDoctor($data['doctor_id'])
                                 ->setRegistrationDetails($data['kelas'], $data['ruangan_kelas'])
                                 ->setAdmissionTime($data['tanggal_masuk'], $data['waktu_masuk'])
                                 ->setInitialDiagnosis($data['diagnosa_awal'])
                                 ->build();
            
            // 3. Trigger initial billing or notification (example)
            // BillingSystem::init($admission);
            
            return $admission;
        });
    }
}
