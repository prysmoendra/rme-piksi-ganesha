<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perawat',
        'no_sipn',
        'spesialisasi',
        'shift',
        'telepon',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all medical actions where this nurse was the accompanying nurse
     */
    public function medicalActions(): HasMany
    {
        return $this->hasMany(MedicalAction::class, 'perawat_pendamping_id');
    }

    /**
     * Get nurse's full name with specialization
     */
    public function getFullNameWithSpecializationAttribute(): string
    {
        return $this->spesialisasi ? "{$this->nama_perawat} ({$this->spesialisasi})" : $this->nama_perawat;
    }
}
