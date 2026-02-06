<?php

namespace App\Patterns\Behavioral\State;

use App\Models\InpatientAdmission;

// State Interface
interface AdmissionState
{
    public function validate(InpatientAdmission $admission);
    public function discharge(InpatientAdmission $admission);
}

// Concrete states
class ActiveState implements AdmissionState
{
    public function validate(InpatientAdmission $admission)
    {
        $admission->is_validated = true;
        $admission->validasi_log .= "\nValidated by System/User.";
        $admission->save();
        
        // Transition requires logic handling in context, but for simple state pattern class:
        // System usually updates a 'state_class' field or similar.
        // For this demo, we just update the model fields.
        return "Admission Validated.";
    }

    public function discharge(InpatientAdmission $admission)
    {
        return "Cannot discharge active patient without validation (Business Rule Example).";
    }
}

class ValidatedState implements AdmissionState
{
    public function validate(InpatientAdmission $admission)
    {
        return "Already validated.";
    }

    public function discharge(InpatientAdmission $admission)
    {
        $admission->status = 'Discharged';
        $admission->save();
        return "Patient Discharged.";
    }
}

class DischargedState implements AdmissionState
{
    public function validate(InpatientAdmission $admission)
    {
        return "Cannot validate discharged patient.";
    }

    public function discharge(InpatientAdmission $admission)
    {
        return "Already discharged.";
    }
}

// Context
class AdmissionContext
{
    private $state;

    public function __construct(AdmissionState $state)
    {
        $this->state = $state;
    }

    public function transitionTo(AdmissionState $state)
    {
        $this->state = $state;
    }

    public function requestValidation(InpatientAdmission $admission)
    {
        return $this->state->validate($admission);
    }

    public function requestDischarge(InpatientAdmission $admission)
    {
        return $this->state->discharge($admission);
    }
}
