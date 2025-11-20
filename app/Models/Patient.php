<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rekam_medis',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'penanggung_jawab',
        'kontak_darurat',
        'jenis_pembayaran',
        'no_surat_jaminan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get all inpatient admissions for this patient
     */
    public function inpatientAdmissions(): HasMany
    {
        return $this->hasMany(InpatientAdmission::class);
    }

    /**
     * Get the latest admission
     */
    public function latestAdmission()
    {
        return $this->hasOne(InpatientAdmission::class)->latest();
    }

    /**
     * Get patient's age
     */
    public function getAgeAttribute(): int
    {
        /** @var Carbon $tanggalLahir */
        $tanggalLahir = $this->tanggal_lahir;
        return $tanggalLahir->diffInYears(Carbon::now());
    }

    /**
     * Get patient's full name with RM number
     */
    public function getFullNameWithRmAttribute(): string
    {
        return "{$this->nama_lengkap} ({$this->id_rekam_medis})";
    }
}
