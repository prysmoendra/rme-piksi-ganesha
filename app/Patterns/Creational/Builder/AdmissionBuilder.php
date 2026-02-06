<?php

namespace App\Patterns\Creational\Builder;

use App\Models\InpatientAdmission;
use App\Models\Patient;

class AdmissionBuilder
{
    protected $admission;
    protected $patient;
    protected $data = [];

    public function __construct()
    {
        $this->admission = new InpatientAdmission();
    }

    public function setPatient(Patient $patient)
    {
        $this->admission->patient_id = $patient->id;
        return $this;
    }

    public function setDoctor($doctorId)
    {
        $this->admission->doctor_id = $doctorId;
        return $this;
    }

    public function setRegistrationDetails($class, $room, $regNumber = null)
    {
        $this->admission->kelas = $class;
        $this->admission->ruangan_kelas = $room; // Assuming room name/class matches
        $this->admission->no_kamar = $room; // Simplification, usually separate
        
        if ($regNumber) {
            $this->admission->nomor_registrasi_inap = $regNumber;
        } else {
             // Generate if not provided
             $this->admission->nomor_registrasi_inap = 'RI-' . date('Ymd') . '-' . mt_rand(100, 999);
        }
        
        return $this;
    }

    public function setAdmissionTime($date, $time)
    {
        $this->admission->tanggal_masuk = $date;
        $this->admission->waktu_masuk = $time;
        return $this;
    }

    public function setInitialDiagnosis($diagnosis)
    {
        $this->admission->diagnosa_awal = $diagnosis;
        return $this;
    }

    public function setStatus($status = 'Active')
    {
        $this->admission->status = $status;
        return $this;
    }

    public function build(): InpatientAdmission
    {
        // Add default values if missing
        if (!$this->admission->nomor_registrasi_inap) {
             throw new \Exception("Registration number is required");
        }
        
        $this->admission->save();
        return $this->admission;
    }
}
