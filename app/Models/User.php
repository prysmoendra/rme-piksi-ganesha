<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'employee_id',
        'department',
        'position',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user is a doctor
     * 
     * @return bool
     */
    public function isDoctor(): bool
    {
        return $this->hasRole('doctor');
    }

    /**
     * Check if user is a nurse
     * 
     * @return bool
     */
    public function isNurse(): bool
    {
        return $this->hasRole('nurse');
    }

    /**
     * Check if user is a pharmacist
     */
    public function isPharmacist(): bool
    {
        return $this->hasRole('pharmacist');
    }

    /**
     * Check if user is a medical records officer
     */
    public function isMedicalRecords(): bool
    {
        return $this->hasRole('medical_records');
    }

    /**
     * Check if user is a super admin
     * 
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Get user's full name with role
     */
    public function getFullNameWithRoleAttribute(): string
    {
        $role = $this->roles->first()?->name ?? 'User';
        return "{$this->name} ({$role})";
    }
}
