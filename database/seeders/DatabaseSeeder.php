<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            DoctorSeeder::class,
            NurseSeeder::class,
            Icd10CodeSeeder::class,
            Icd9CodeSeeder::class,
            MedicationFormularySeeder::class,
        ]);

        // Create default super admin user
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@piksi-ganesha.com',
            'employee_id' => 'EMP001',
            'department' => 'IT',
            'position' => 'System Administrator',
        ]);
        $superAdmin->assignRole('super_admin');

        // Create sample doctor
        $doctor = User::factory()->create([
            'name' => 'Dr. John Doe',
            'email' => 'doctor@piksi-ganesha.com',
            'employee_id' => 'DOC001',
            'department' => 'Internal Medicine',
            'position' => 'Attending Physician',
        ]);
        $doctor->assignRole('doctor');

        // Create sample nurse
        $nurse = User::factory()->create([
            'name' => 'Nurse Jane Smith',
            'email' => 'nurse@piksi-ganesha.com',
            'employee_id' => 'NUR001',
            'department' => 'Internal Medicine',
            'position' => 'Registered Nurse',
        ]);
        $nurse->assignRole('nurse');
    }
}
