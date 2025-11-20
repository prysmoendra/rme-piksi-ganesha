@extends('layouts.app')

@section('title', 'Dashboard - RME Rawat Inap')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Patients -->
        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary-blue bg-opacity-10">
                    <svg class="w-6 h-6 text-primary-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-text-secondary">Total Pasien</p>
                    <p class="text-2xl font-semibold text-text-primary">{{ number_format($totalPatients) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Admissions -->
        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-success bg-opacity-10">
                    <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-text-secondary">Total Rawat Inap</p>
                    <p class="text-2xl font-semibold text-text-primary">{{ number_format($totalAdmissions) }}</p>
                </div>
            </div>
        </div>

        <!-- Active Admissions -->
        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-warning bg-opacity-10">
                    <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-text-secondary">Sedang Dirawat</p>
                    <p class="text-2xl font-semibold text-text-primary">{{ number_format($activeAdmissions) }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Validations -->
        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-error bg-opacity-10">
                    <svg class="w-6 h-6 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-text-secondary">Menunggu Validasi</p>
                    <p class="text-2xl font-semibold text-text-primary">{{ number_format($pendingValidations) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h3 class="text-lg font-semibold text-text-primary mb-4">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admissions.create') }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Pasien Baru
            </a>
            <a href="{{ route('admissions.index') }}" class="btn-secondary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Lihat Semua Pasien
            </a>
        </div>
    </div>

    <!-- Recent Admissions -->
    <div class="card">
        <h3 class="text-lg font-semibold text-text-primary mb-4">Rawat Inap Terbaru</h3>
        @if($recentAdmissions->count() > 0)
            <div class="overflow-x-auto">
                <table class="table-striped w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. RM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentAdmissions as $admission)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $admission->patient->id_rekam_medis }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $admission->patient->nama_lengkap }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $admission->doctor->nama_dokter }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $admission->tanggal_masuk->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $admission->status === 'Active' ? 'bg-green-100 text-green-800' : 
                                       ($admission->status === 'Discharged' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $admission->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admissions.show', $admission->id) }}" class="text-primary-blue hover:text-blue-900">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada data rawat inap.</p>
        @endif
    </div>
</div>
@endsection
