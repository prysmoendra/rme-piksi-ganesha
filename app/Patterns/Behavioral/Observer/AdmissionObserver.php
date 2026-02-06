<?php

namespace App\Patterns\Behavioral\Observer;

use App\Models\InpatientAdmission;
use Illuminate\Support\Facades\Log;

class AdmissionObserver
{
    /**
     * Handle the InpatientAdmission "created" event.
     */
    public function created(InpatientAdmission $admission): void
    {
        Log::info("New Admission Created: " . $admission->nomor_registrasi_inap);
        
        // Example: Create an initial blank billing record
        // Billing::create(['admission_id' => $admission->id, 'total' => 0]);
    }

    /**
     * Handle the InpatientAdmission "updated" event.
     */
    public function updated(InpatientAdmission $admission): void
    {
        if ($admission->isDirty('status')) {
            Log::info("Admission Status Changed: " . $admission->status);
        }

        if ($admission->isDirty('is_validated') && $admission->is_validated) {
            Log::info("Admission Validated by User ID: " . $admission->validated_by);
            // Send notification to nurse station
        }
    }
}
