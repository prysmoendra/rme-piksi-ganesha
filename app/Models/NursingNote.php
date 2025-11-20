<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NursingNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'inpatient_admission_id',
        'tanggal_waktu',
        'tujuan_keperawatan',
        'intervensi_keperawatan',
        'frekuensi_durasi',
        'petugas_penanggung_jawab',
        'created_by',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    /**
     * Get the inpatient admission that owns this nursing note
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the user who created this nursing note
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
