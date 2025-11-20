<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inpatient_admission_id',
        'jenis_tindakan',
        'tanggal',
        'dokter_operator_id',
        'perawat_pendamping_id',
        'ringkasan_tindakan',
        'komplikasi',
        'created_by',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Get the inpatient admission that owns this medical action
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the operating doctor
     */
    public function dokterOperator(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'dokter_operator_id');
    }

    /**
     * Get the accompanying nurse
     */
    public function perawatPendamping(): BelongsTo
    {
        return $this->belongsTo(Nurse::class, 'perawat_pendamping_id');
    }

    /**
     * Get the user who created this medical action
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
