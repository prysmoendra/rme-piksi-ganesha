<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class InpatientAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nomor_registrasi_inap',
        'kelas',
        'doctor_id',
        'tanggal_masuk',
        'waktu_masuk',
        'tanggal_keluar',
        'waktu_keluar',
        'ruangan_kelas',
        'no_kamar',
        'diagnosa_awal',
        'lama_rawat',
        'status',
        'is_validated',
        'validated_by',
        'validated_at',
        'validasi_log',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
        'waktu_masuk' => 'datetime:H:i',
        'waktu_keluar' => 'datetime:H:i',
        'is_validated' => 'boolean',
        'validated_at' => 'datetime',
    ];

    /**
     * Get the patient that owns this admission
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor responsible for this admission
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the user who validated this admission
     */
    public function validatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * Get the clinical data for this admission
     */
    public function clinicalData(): HasOne
    {
        return $this->hasOne(ClinicalDataDoctor::class);
    }

    /**
     * Get all nursing notes for this admission
     */
    public function nursingNotes(): HasMany
    {
        return $this->hasMany(NursingNote::class);
    }

    /**
     * Get all pharmacy records for this admission
     */
    public function pharmacyRecords(): HasMany
    {
        return $this->hasMany(PharmacyRecord::class);
    }

    /**
     * Get all medical actions for this admission
     */
    public function medicalActions(): HasMany
    {
        return $this->hasMany(MedicalAction::class);
    }

    /**
     * Get all SOAP notes for this admission
     */
    public function soapNotes(): HasMany
    {
        return $this->hasMany(DoctorDailyNoteSoap::class);
    }

    /**
     * Get the discharge resume for this admission
     */
    public function dischargeResume(): HasOne
    {
        return $this->hasOne(DischargeResume::class);
    }

    /**
     * Get all uploaded documents for this admission
     */
    public function uploadedDocuments(): HasMany
    {
        return $this->hasMany(UploadedDocument::class);
    }

    /**
     * Calculate length of stay
     */
    public function calculateLengthOfStay(): int
    {
        if (!$this->tanggal_keluar) {
            return Carbon::parse($this->tanggal_masuk)->diffInDays(Carbon::now());
        }
        
        return Carbon::parse($this->tanggal_masuk)->diffInDays(Carbon::parse($this->tanggal_keluar));
    }

    /**
     * Get admission summary
     */
    public function getAdmissionSummaryAttribute(): string
    {
        return "{$this->patient->nama_lengkap} - {$this->doctor->nama_dokter} - {$this->kelas}";
    }
}
