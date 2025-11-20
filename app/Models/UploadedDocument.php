<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'inpatient_admission_id',
        'document_type',
        'original_name',
        'file_path',
        'file_extension',
        'file_size',
        'description',
        'uploaded_by',
    ];

    /**
     * Get the inpatient admission that owns this document
     */
    public function inpatientAdmission(): BelongsTo
    {
        return $this->belongsTo(InpatientAdmission::class);
    }

    /**
     * Get the user who uploaded this document
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get file size in human readable format
     */
    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
