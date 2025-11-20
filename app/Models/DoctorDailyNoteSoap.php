<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorDailyNoteSoap extends Model
{
    use HasFactory;

    protected $table = 'doctor_daily_notes_soap';

    protected $fillable = [
        'inpatient_admission_id',
        'tanggal_waktu',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'tanda_tangan_digital',
        'doctor_id',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    /**
     * Get the inpatient admission that owns this SOAP note
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the doctor who created this SOAP note
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
