<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dokter',
        'spesialisasi',
        'no_sip',
        'alamat_praktik',
        'telepon',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all inpatient admissions for this doctor
     */
    public function inpatientAdmissions(): HasMany
    {
        return $this->hasMany(InpatientAdmission::class);
    }

    /**
     * Get all medical actions performed by this doctor
     */
    public function medicalActions(): HasMany
    {
        return $this->hasMany(MedicalAction::class, 'dokter_operator_id');
    }

    /**
     * Get doctor's full name with specialization
     */
    public function getFullNameWithSpecializationAttribute(): string
    {
        return $this->spesialisasi ? "{$this->nama_dokter} ({$this->spesialisasi})" : $this->nama_dokter;
    }
}
