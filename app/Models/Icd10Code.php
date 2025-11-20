<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Icd10Code extends Model
{
    use HasFactory;

    protected $table = 'icd_10_codes';

    protected $fillable = [
        'code',
        'description',
        'category',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the code with description
     */
    public function getCodeWithDescriptionAttribute(): string
    {
        return "{$this->code} - {$this->description}";
    }
}
