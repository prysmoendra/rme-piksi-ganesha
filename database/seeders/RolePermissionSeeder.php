<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Patient Management
            'view_patients',
            'create_patients',
            'edit_patients',
            'delete_patients',
            
            // Admission Management
            'view_admissions',
            'create_admissions',
            'edit_admissions',
            'validate_admissions',
            
            // Clinical Data
            'view_clinical_data',
            'edit_clinical_data',
            'create_soap_notes',
            'edit_soap_notes',
            
            // Nursing
            'view_nursing_notes',
            'create_nursing_notes',
            'edit_nursing_notes',
            
            // Pharmacy
            'view_pharmacy_data',
            'edit_pharmacy_data',
            'manage_medications',
            
            // Documents
            'upload_documents',
            'view_documents',
            'delete_documents',
            
            // Reports
            'export_data',
            'view_reports',
            'generate_reports',
            
            // Administration
            'manage_users',
            'manage_system_settings',
            'view_audit_logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $doctor = Role::firstOrCreate(['name' => 'doctor']);
        $doctor->syncPermissions([
            'view_patients',
            'create_patients',
            'edit_patients',
            'view_admissions',
            'create_admissions',
            'edit_admissions',
            'view_clinical_data',
            'edit_clinical_data',
            'create_soap_notes',
            'edit_soap_notes',
            'view_nursing_notes',
            'view_pharmacy_data',
            'edit_pharmacy_data',
            'upload_documents',
            'view_documents',
            'export_data',
            'view_reports',
        ]);

        $nurse = Role::firstOrCreate(['name' => 'nurse']);
        $nurse->syncPermissions([
            'view_patients',
            'view_admissions',
            'view_clinical_data',
            'view_nursing_notes',
            'create_nursing_notes',
            'edit_nursing_notes',
            'view_pharmacy_data',
            'upload_documents',
            'view_documents',
            'view_reports',
        ]);

        $pharmacist = Role::firstOrCreate(['name' => 'pharmacist']);
        $pharmacist->syncPermissions([
            'view_patients',
            'view_admissions',
            'view_pharmacy_data',
            'edit_pharmacy_data',
            'manage_medications',
            'upload_documents',
            'view_documents',
            'view_reports',
        ]);

        $medicalRecords = Role::firstOrCreate(['name' => 'medical_records']);
        $medicalRecords->syncPermissions([
            'view_patients',
            'edit_patients',
            'view_admissions',
            'edit_admissions',
            'validate_admissions',
            'view_clinical_data',
            'view_nursing_notes',
            'view_pharmacy_data',
            'upload_documents',
            'view_documents',
            'delete_documents',
            'export_data',
            'view_reports',
            'generate_reports',
            'view_audit_logs',
        ]);

        $registrationStaff = Role::firstOrCreate(['name' => 'registration_staff']);
        $registrationStaff->syncPermissions([
            'view_patients',
            'create_patients',
            'edit_patients',
            'view_admissions',
            'create_admissions',
            'upload_documents',
            'view_documents',
            'view_reports',
        ]);
    }
}
