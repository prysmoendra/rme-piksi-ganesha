<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DischargeResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'inpatient_admission_id',
        'tanggal_pulang',
        'kondisi_saat_pulang',
        'diagnosa_akhir',
        'terapi_pulang',
        'tindak_lanjut',
        'edukasi_akhir',
        'tanda_tangan_perawat',
        'tanda_tangan_dokter',
        'created_by',
    ];

    protected $casts = [
        'tanggal_pulang' => 'date',
    ];

    /**
     * Get the inpatient admission that owns this discharge resume
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the user who created this discharge resume
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
