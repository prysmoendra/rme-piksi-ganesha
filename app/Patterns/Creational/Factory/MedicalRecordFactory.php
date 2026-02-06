<?php

namespace App\Patterns\Creational\Factory;

use App\Models\NursingNote;
use App\Models\DoctorDailyNoteSoap;
use App\Models\DischargeResume;
use Illuminate\Support\Facades\Auth;

class MedicalRecordFactory
{
    public static function create(string $type, array $data)
    {
        switch ($type) {
            case 'nursing_note':
                return self::createNursingNote($data);
            case 'soap_note':
                return self::createSoapNote($data);
            case 'discharge_resume':
                return self::createDischargeResume($data);
            default:
                throw new \Exception("Unknown medical record type: $type");
        }
    }

    private static function createNursingNote($data)
    {
        $data['created_by'] = Auth::id() ?? 1; // Fallback for demo
        return NursingNote::create($data);
    }

    private static function createSoapNote($data)
    {
        $data['doctor_id'] = Auth::id() ?? 1; // Fallback for demo
        return DoctorDailyNoteSoap::create($data);
    }

    private static function createDischargeResume($data)
    {
        $data['created_by'] = Auth::id() ?? 1; // Fallback for demo
        return DischargeResume::create($data);
    }
}
