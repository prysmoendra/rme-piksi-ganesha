<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicalDataDoctor extends Model
{
    use HasFactory;

    protected $table = 'clinical_data_doctor';

    protected $fillable = [
        'inpatient_admission_id',
        'keluhan_utama',
        'riwayat_penyakit_sekarang',
        'riwayat_penyakit_dahulu',
        'ttv',
        'tinggi_badan',
        'berat_badan',
        'hasil_pemeriksaan_penunjang',
        'diagnosa_kerja',
        'diagnosa_kerja_icd9',
        'diagnosa_banding',
        'diagnosa_banding_icd9',
        'created_by',
    ];

    protected $casts = [
        'ttv' => 'array',
        'tinggi_badan' => 'decimal:2',
        'berat_badan' => 'decimal:2',
    ];

    /**
     * Get the inpatient admission that owns this clinical data
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the user who created this clinical data
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the ICD-10 description for Diagnosa Kerja
     */
    public function diagnosaKerjaIcd10(): BelongsTo
    {
        return $this->belongsTo(Icd10Code::class, 'diagnosa_kerja', 'code');
    }

    /**
     * Get the ICD-9 description for Diagnosa Kerja
     */
    public function diagnosaKerjaIcd9(): BelongsTo
    {
        return $this->belongsTo(Icd9Code::class, 'diagnosa_kerja_icd9', 'code');
    }

    /**
     * Get the ICD-10 description for Diagnosa Banding
     */
    public function diagnosaBandingIcd10(): BelongsTo
    {
        return $this->belongsTo(Icd10Code::class, 'diagnosa_banding', 'code');
    }

    /**
     * Get the ICD-9 description for Diagnosa Banding
     */
    public function diagnosaBandingIcd9(): BelongsTo
    {
        return $this->belongsTo(Icd9Code::class, 'diagnosa_banding_icd9', 'code');
    }
}
