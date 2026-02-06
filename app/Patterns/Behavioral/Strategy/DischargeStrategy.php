<?php

namespace App\Patterns\Behavioral\Strategy;

use App\Models\InpatientAdmission;

// Strategy Interface
interface DischargeStrategy
{
    public function discharge(InpatientAdmission $admission);
}

// Concrete Strategies
class RegularDischarge implements DischargeStrategy
{
    public function discharge(InpatientAdmission $admission)
    {
        $admission->status = 'Discharged';
        $admission->tanggal_keluar = now()->toDateString();
        $admission->waktu_keluar = now()->toTimeString();
        $admission->save();

        // Specific logic: Print Regular Discharge Letter
        return "Pasien Pulang Sehat. Surat Kontrol dibuat.";
    }
}

class ReferralDischarge implements DischargeStrategy
{
    public function discharge(InpatientAdmission $admission)
    {
        $admission->status = 'Transferred';
        $admission->tanggal_keluar = now()->toDateString();
        $admission->save();

        // Specific logic: Prepare Referral Documents
        return "Pasien Dirujuk. Surat Rujukan disiapkan.";
    }
}

class DeadOnDepartureDischarge implements DischargeStrategy
{
    public function discharge(InpatientAdmission $admission)
    {
        $admission->status = 'Deceased';
        $admission->tanggal_keluar = now()->toDateString();
        $admission->save();

        // Specific logic: Prepare Death Certificate
        return "Pasien Meninggal. Surat Kematian disiapkan.";
    }
}

// Context
class DischargeContext
{
    private $strategy;

    public function setStrategy(DischargeStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeDischarge(InpatientAdmission $admission)
    {
        if (!$this->strategy) {
            throw new \Exception("Discharge Strategy not set");
        }
        return $this->strategy->discharge($admission);
    }
}
