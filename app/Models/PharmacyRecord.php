<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'inpatient_admission_id',
        'nama_obat',
        'dosis_frekuensi',
        'rak_pemberian',
        'waktu_pemberian',
        'status',
        'catatan_obat_lanjutan',
        'tanda_tangan_digital',
        'created_by',
    ];

    protected $casts = [
        'waktu_pemberian' => 'datetime:H:i',
    ];

    /**
     * Get the inpatient admission that owns this pharmacy record
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the user who created this pharmacy record
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
