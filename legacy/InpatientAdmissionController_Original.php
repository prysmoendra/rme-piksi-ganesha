<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InpatientAdmission;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Icd10Code;
use App\Models\Icd9Code;
use App\Models\MedicationFormulary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InpatientAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = InpatientAdmission::with(['patient', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view('admissions.index', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::where('is_active', true)->get();
        $nurses = Nurse::where('is_active', true)->get();
        $icd10Codes = Icd10Code::where('is_active', true)->get();
        $icd9Codes = Icd9Code::where('is_active', true)->get();
        $medications = MedicationFormulary::where('is_active', true)->get();

        return view('admissions.create', compact('doctors', 'nurses', 'icd10Codes', 'icd9Codes', 'medications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Step 1 & 2: Create or find patient with both step1 and step2 data
            $patient = $this->createOrUpdatePatient($request->step1, $request->step2);
            
            // Step 2: Create admission (combine step1 and step2 data)
            $admission = $this->createAdmission($request->step1, $request->step2, $patient->id);
            
            // Step 3: Create clinical data (if provided)
            if ($request->has('step3')) {
                $this->createClinicalData($request->step3, $admission->id);
            }
            
            // Step 4: Create nursing notes (if provided)
            if ($request->has('step4')) {
                $this->createNursingNotes($request->step4, $admission->id);
            }
            
            // Step 5: Create pharmacy records and medical actions (if provided)
            if ($request->has('step5_pharmacy')) {
                $this->createPharmacyRecords($request->step5_pharmacy, $admission->id);
            }
            if ($request->has('step5_actions')) {
                $this->createMedicalActions($request->step5_actions, $admission->id);
            }
            
            // Step 6: Create SOAP notes (if provided)
            if ($request->has('step6')) {
                $this->createSoapNotes($request->step6, $admission->id);
            }
            
            // Step 7: Create discharge resume (if provided)
            if ($request->has('step7')) {
                $this->createDischargeResume($request->step7, $admission->id);
            }
            
            // Step 8: Validate admission (if provided)
            if ($request->has('step8') && $request->step8['validate']) {
                $this->validateAdmission($admission->id);
            }

            DB::commit();

            return redirect()->route('admissions.show', $admission->id)
                ->with('success', 'Data pasien berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InpatientAdmission $admission)
    {
        $admission->load([
            'patient',
            'doctor',
            'clinicalData.diagnosaKerjaIcd10',
            'clinicalData.diagnosaKerjaIcd9',
            'clinicalData.diagnosaBandingIcd10',
            'clinicalData.diagnosaBandingIcd9',
            'nursingNotes',
            'pharmacyRecords',
            'medicalActions',
            'soapNotes',
            'dischargeResume',
            'uploadedDocuments'
        ]);

        return view('admissions.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InpatientAdmission $admission)
    {
        if ($admission->is_validated) {
            return redirect()->route('admissions.show', $admission->id)
                ->withErrors(['error' => 'Data yang sudah divalidasi tidak dapat diedit.']);
        }

        $admission->load([
            'patient',
            'clinicalData',
            'nursingNotes',
            'pharmacyRecords',
            'medicalActions',
            'soapNotes',
            'dischargeResume'
        ]);

        $doctors = Doctor::where('is_active', true)->get();
        $nurses = Nurse::where('is_active', true)->get();
        $icd10Codes = Icd10Code::where('is_active', true)->get();
        $icd9Codes = Icd9Code::where('is_active', true)->get();
        $medications = MedicationFormulary::where('is_active', true)->get();

        return view('admissions.edit', compact('admission', 'doctors', 'nurses', 'icd10Codes', 'icd9Codes', 'medications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InpatientAdmission $admission)
    {
        if ($admission->is_validated) {
            return back()->withErrors(['error' => 'Data yang sudah divalidasi tidak dapat diedit.']);
        }

        try {
            DB::beginTransaction();

            // Update patient data
            if ($request->has('step1')) {
                $this->updatePatient($admission->patient, $request->step1);
            }

            // Update admission data
            if ($request->has('step2')) {
                $this->updateAdmission($admission, $request->step2);
            }

            // Update other steps as needed...

            DB::commit();

            return redirect()->route('admissions.show', $admission->id)
                ->with('success', 'Data pasien berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InpatientAdmission $admission)
    {
        if ($admission->is_validated) {
            return back()->withErrors(['error' => 'Data yang sudah divalidasi tidak dapat dihapus.']);
        }

        $admission->delete();

        return redirect()->route('admissions.index')
            ->with('success', 'Data pasien berhasil dihapus!');
    }

    // Helper methods for creating/updating data
    private function createOrUpdatePatient($step1Data, $step2Data = null)
    {
        // Generate RM number if not provided
        if (empty($step1Data['id_rekam_medis'])) {
            $step1Data['id_rekam_medis'] = 'RM-' . str_pad(Patient::count() + 1, 5, '0', STR_PAD_LEFT);
        }

        // Merge step1 and step2 data for patient creation
        $patientData = [
            'id_rekam_medis' => $step1Data['id_rekam_medis'],
        ];

        // Add step2 data if provided
        if ($step2Data) {
            $patientData = array_merge($patientData, [
                'nama_lengkap' => $step2Data['nama_lengkap'] ?? '',
                'nik' => $step2Data['nik'] ?? '',
                'jenis_kelamin' => $step2Data['jenis_kelamin'] ?? '',
                'tanggal_lahir' => $step2Data['tanggal_lahir'] ?? null,
                'alamat' => $step2Data['alamat'] ?? '',
                'telepon' => $step2Data['telepon'] ?? '',
                'penanggung_jawab' => $step2Data['penanggung_jawab'] ?? '',
                'kontak_darurat' => $step2Data['kontak_darurat'] ?? '',
                'jenis_pembayaran' => $step2Data['jenis_pembayaran'] ?? '',
                'no_surat_jaminan' => $step2Data['no_surat_jaminan'] ?? '',
            ]);
        }

        return Patient::create($patientData);
    }

    private function createAdmission($step1Data, $step2Data, $patientId)
    {
        // Generate admission number
        $admissionData = [
            'nomor_registrasi_inap' => 'RI-' . date('Ymd') . '-' . str_pad(InpatientAdmission::count() + 1, 3, '0', STR_PAD_LEFT),
            'patient_id' => $patientId,
            'kelas' => $step1Data['kelas'] ?? '',
            'doctor_id' => $step1Data['doctor_id'] ?? null,
            'tanggal_masuk' => $step2Data['tanggal_masuk'] ?? null,
            'waktu_masuk' => $step2Data['waktu_masuk'] ?? null,
            'ruangan_kelas' => $step2Data['ruangan_kelas'] ?? '',
            'no_kamar' => $step2Data['no_kamar'] ?? '',
            'diagnosa_awal' => $step2Data['diagnosa_awal'] ?? '',
            'status' => 'Active',
            'is_validated' => false,
        ];

        return InpatientAdmission::create($admissionData);
    }

    private function createClinicalData($data, $admissionId)
    {
        $data['inpatient_admission_id'] = $admissionId;
        $data['created_by'] = Auth::id();

        return \App\Models\ClinicalDataDoctor::create($data);
    }

    private function createNursingNotes($data, $admissionId)
    {
        $data['inpatient_admission_id'] = $admissionId;
        $data['created_by'] = Auth::id();

        return \App\Models\NursingNote::create($data);
    }

    private function createPharmacyRecords($data, $admissionId)
    {
        foreach ($data as $record) {
            $record['inpatient_admission_id'] = $admissionId;
            $record['created_by'] = Auth::id();
            \App\Models\PharmacyRecord::create($record);
        }
    }

    private function createMedicalActions($data, $admissionId)
    {
        foreach ($data as $action) {
            $action['inpatient_admission_id'] = $admissionId;
            $action['created_by'] = Auth::id();
            \App\Models\MedicalAction::create($action);
        }
    }

    private function createSoapNotes($data, $admissionId)
    {
        $data['inpatient_admission_id'] = $admissionId;
        $data['doctor_id'] = Auth::id();

        return \App\Models\DoctorDailyNoteSoap::create($data);
    }

    private function createDischargeResume($data, $admissionId)
    {
        $data['inpatient_admission_id'] = $admissionId;
        $data['created_by'] = Auth::id();

        return \App\Models\DischargeResume::create($data);
    }

    private function validateAdmission($admissionId)
    {
        $admission = InpatientAdmission::find($admissionId);
        $admission->update([
            'is_validated' => true,
            'validated_by' => Auth::id(),
            'validated_at' => now(),
            'validasi_log' => "Validasi dilakukan oleh " . Auth::user()->name . " pada " . now()->format('d/m/Y H:i:s')
        ]);
    }

    private function updatePatient($patient, $data)
    {
        $patient->update($data);
    }

    private function updateAdmission($admission, $data)
    {
        $admission->update($data);
    }
}
