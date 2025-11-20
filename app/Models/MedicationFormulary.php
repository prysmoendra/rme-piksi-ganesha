<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicationFormulary extends Model
{
    use HasFactory;

    protected $table = 'medication_formulary';

    protected $fillable = [
        'nama_obat',
        'kode_obat',
        'deskripsi',
        'satuan',
        'kategori',
        'indikasi',
        'kontraindikasi',
        'harga',
        'is_active',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the medication name with code
     */
    public function getNamaObatWithCodeAttribute(): string
    {
        return "{$this->nama_obat} ({$this->kode_obat})";
    }
}
