<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InpatientAdmission;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Nurse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $totalPatients = Patient::count();
        $totalAdmissions = InpatientAdmission::count();
        $activeAdmissions = InpatientAdmission::where('status', 'Active')->count();
        $pendingValidations = InpatientAdmission::where('is_validated', false)->count();

        // Get recent admissions
        $recentAdmissions = InpatientAdmission::with(['patient', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get statistics by user role
        $userStats = $this->getUserRoleStats();

        return view('dashboard', compact(
            'totalPatients',
            'totalAdmissions', 
            'activeAdmissions',
            'pendingValidations',
            'recentAdmissions',
            'userStats'
        ));
    }

    private function getUserRoleStats()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->isSuperAdmin()) {
            return [
                'my_admissions' => InpatientAdmission::count(),
                'my_patients' => Patient::count(),
                'my_soap_notes' => 0,
                'my_nursing_notes' => 0,
            ];
        }

        if ($user->isDoctor()) {
            return [
                'my_admissions' => InpatientAdmission::where('doctor_id', $user->id)->count(),
                'my_patients' => InpatientAdmission::where('doctor_id', $user->id)->distinct('patient_id')->count(),
                'my_soap_notes' => \App\Models\DoctorDailyNoteSoap::where('doctor_id', $user->id)->count(),
                'my_nursing_notes' => 0,
            ];
        }

        if ($user->isNurse()) {
            return [
                'my_admissions' => InpatientAdmission::count(),
                'my_patients' => Patient::count(),
                'my_soap_notes' => 0,
                'my_nursing_notes' => \App\Models\NursingNote::where('created_by', $user->id)->count(),
            ];
        }

        return [
            'my_admissions' => 0,
            'my_patients' => 0,
            'my_soap_notes' => 0,
            'my_nursing_notes' => 0,
        ];
    }
}
