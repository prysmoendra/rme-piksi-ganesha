<?php

namespace App\Patterns\Structural\Proxy;

use Illuminate\Support\Facades\Auth;

interface MedicalRecordInterface
{
    public function getDetails();
}

// Real Subject
class RealMedicalRecord implements MedicalRecordInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getDetails()
    {
        return $this->data;
    }
}

// Proxy
class SecureMedicalRecord implements MedicalRecordInterface
{
    private $realRecord;
    private $requiredRole;

    public function __construct(RealMedicalRecord $record, $role = 'Doctor')
    {
        $this->realRecord = $record;
        $this->requiredRole = $role;
    }

    public function getDetails()
    {
        if ($this->checkAccess()) {
            return $this->realRecord->getDetails();
        } else {
            throw new \Exception("Access Denied. Role '{$this->requiredRole}' required.");
        }
    }

    private function checkAccess()
    {
        // Simple security check simulation
        $user = Auth::user();
        
        // In real app: $user->hasRole($this->requiredRole)
        // For demo, assuming any logged in user can view if no specific logic
        if (!$user) return false;

        return true; 
    }
}
