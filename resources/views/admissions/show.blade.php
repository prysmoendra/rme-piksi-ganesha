@extends('layouts.app')

@section('title', 'Detail Pasien - RME Rawat Inap')
@section('page-title', 'Detail Pasien')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header with Actions -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Detail Pasien</h1>
            <p class="text-gray-600 mt-1">{{ $admission->patient->nama_lengkap ?? 'Nama tidak tersedia' }}</p>
        </div>
        <div class="flex space-x-3">
            @if(!$admission->is_validated)
                <a href="{{ route('admissions.edit', $admission->id) }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
            @endif
            <a href="{{ route('admissions.index') }}" class="btn-link gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="mb-6">
        @if($admission->is_validated)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Sudah Divalidasi
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                Belum Divalidasi
            </span>
        @endif
    </div>

    <!-- Step 1: Data Awal -->
    <div class="card mb-6">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">1</div>
            <h3 class="text-lg font-semibold text-text-primary">Data Awal</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Nomor RM</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->id_rekam_medis ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Kelas</label>
                <p class="text-text-primary font-medium">{{ $admission->kelas ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Dokter Penanggung Jawab</label>
                <p class="text-text-primary font-medium">{{ $admission->doctor->nama_dokter ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Step 2: Identitas Pasien -->
    <div class="card mb-6" id="identitas-pasien">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">2</div>
            <h3 class="text-lg font-semibold text-text-primary">Identitas Pasien</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->nama_lengkap ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">NIK/BPJS</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->nik ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->jenis_kelamin ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->tanggal_lahir ? \Carbon\Carbon::parse($admission->patient->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->alamat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Telepon</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->telepon ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Penanggung Jawab</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->penanggung_jawab ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Kontak Darurat</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->kontak_darurat ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Pembayaran</label>
                <p class="text-text-primary font-medium">{{ $admission->patient->jenis_pembayaran ?? '-' }}</p>
            </div>
        </div>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Masuk</label>
                <p class="text-text-primary font-medium">{{ $admission->tanggal_masuk ? \Carbon\Carbon::parse($admission->tanggal_masuk)->format('d/m/Y') : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Waktu Masuk</label>
                <p class="text-text-primary font-medium">{{ $admission->waktu_masuk ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Ruangan/Kelas</label>
                <p class="text-text-primary font-medium">{{ $admission->ruangan_kelas ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">No. Kamar</label>
                <p class="text-text-primary font-medium">{{ $admission->no_kamar ?? '-' }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 mb-1">Diagnosa Awal</label>
                <p class="text-text-primary font-medium">{{ $admission->diagnosa_awal ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Step 3: Data Klinis Dokter -->
    @if($admission->clinicalData)
    <div class="card mb-6" id="data-klinis-dokter">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">3</div>
            <h3 class="text-lg font-semibold text-text-primary">Data Klinis Dokter</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Keluhan Utama</label>
                <p class="text-text-primary">{{ $admission->clinicalData->keluhan_utama ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Riwayat Penyakit Sekarang</label>
                <p class="text-text-primary">{{ $admission->clinicalData->riwayat_penyakit_sekarang ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Riwayat Penyakit Dahulu</label>
                <p class="text-text-primary">{{ $admission->clinicalData->riwayat_penyakit_dahulu ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Hasil Pemeriksaan Penunjang</label>
                <p class="text-text-primary">{{ $admission->clinicalData->hasil_pemeriksaan_penunjang ?? '-' }}</p>
            </div>
        </div>
        
        <!-- Diagnosis Section -->
        <div class="mt-8 border-t border-gray-200 pt-6">
            <h4 class="text-md font-semibold text-text-primary mb-4">Diagnosa</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Diagnosa Kerja -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h5 class="text-sm font-semibold text-text-primary mb-3">Diagnosa Kerja</h5>
                    
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-500 mb-1">ICD-10</label>
                        <p class="text-text-primary font-medium">{{ $admission->clinicalData->diagnosa_kerja ?? '-' }}</p>
                        @if($admission->clinicalData->diagnosaKerjaIcd10)
                            <p class="text-sm text-gray-600 mt-1">{{ $admission->clinicalData->diagnosaKerjaIcd10->description }}</p>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">ICD-9</label>
                        <p class="text-text-primary font-medium">{{ $admission->clinicalData->diagnosa_kerja_icd9 ?? '-' }}</p>
                        @if($admission->clinicalData->diagnosaKerjaIcd9)
                            <p class="text-sm text-gray-600 mt-1">{{ $admission->clinicalData->diagnosaKerjaIcd9->description }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Diagnosa Banding -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h5 class="text-sm font-semibold text-text-primary mb-3">Diagnosa Banding</h5>
                    
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-500 mb-1">ICD-10</label>
                        <p class="text-text-primary font-medium">{{ $admission->clinicalData->diagnosa_banding ?? '-' }}</p>
                        @if($admission->clinicalData->diagnosaBandingIcd10)
                            <p class="text-sm text-gray-600 mt-1">{{ $admission->clinicalData->diagnosaBandingIcd10->description }}</p>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">ICD-9</label>
                        <p class="text-text-primary font-medium">{{ $admission->clinicalData->diagnosa_banding_icd9 ?? '-' }}</p>
                        @if($admission->clinicalData->diagnosaBandingIcd9)
                            <p class="text-sm text-gray-600 mt-1">{{ $admission->clinicalData->diagnosaBandingIcd9->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 4: Catatan Keperawatan -->
    @if($admission->nursingNotes->count() > 0)
    <div class="card mb-6">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">4</div>
            <h3 class="text-lg font-semibold text-text-primary">Catatan Keperawatan</h3>
        </div>
        
        @foreach($admission->nursingNotes as $index => $note)
        <div class="mb-6 {{ $index > 0 ? 'border-t border-gray-200 pt-6' : '' }}">
            @if($admission->nursingNotes->count() > 1)
                <h4 class="text-md font-semibold text-text-primary mb-3">Catatan #{{ $index + 1 }}</h4>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal & Waktu</label>
                    <p class="text-text-primary">{{ $note->tanggal_waktu ? \Carbon\Carbon::parse($note->tanggal_waktu)->format('d/m/Y H:i') : '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Frekuensi & Durasi</label>
                    <p class="text-text-primary">{{ $note->frekuensi_durasi ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Petugas Penanggung Jawab</label>
                    <p class="text-text-primary">{{ $note->petugas_penanggung_jawab ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tujuan Keperawatan</label>
                    <p class="text-text-primary">{{ $note->tujuan_keperawatan ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Intervensi Keperawatan</label>
                    <p class="text-text-primary">{{ $note->intervensi_keperawatan ?? '-' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Step 5: Resep & Tindakan -->
    @if($admission->pharmacyRecords->count() > 0 || $admission->medicalActions->count() > 0)
    <div class="card mb-6" id="data-farmasi-tindakan">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">5</div>
            <h3 class="text-lg font-semibold text-text-primary">Resep & Tindakan</h3>
        </div>
        
        @if($admission->pharmacyRecords->count() > 0)
        <div class="mb-6">
            <h4 class="text-md font-semibold text-text-primary mb-3">Resep Obat</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosis & Frekuensi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rak Pemberian</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pemberian</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($admission->pharmacyRecords as $record)
                        <tr>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $record->nama_obat ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $record->dosis_frekuensi ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $record->rak_pemberian ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $record->waktu_pemberian ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if($admission->medicalActions->count() > 0)
        <div>
            <h4 class="text-md font-semibold text-text-primary mb-3">Tindakan Medis</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tindakan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ringkasan Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($admission->medicalActions as $action)
                        <tr>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $action->jenis_tindakan ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $action->tanggal ? \Carbon\Carbon::parse($action->tanggal)->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-3 text-sm text-text-primary">{{ $action->ringkasan_tindakan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Step 6: Catatan SOAP -->
    @if($admission->soapNotes->count() > 0)
    <div class="card mb-6" id="soap">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">6</div>
            <h3 class="text-lg font-semibold text-text-primary">Catatan SOAP</h3>
        </div>
        
        @foreach($admission->soapNotes as $index => $soapNote)
        <div class="mb-6 {{ $index > 0 ? 'border-t border-gray-200 pt-6' : '' }}">
            @if($admission->soapNotes->count() > 1)
                <h4 class="text-md font-semibold text-text-primary mb-3">Catatan SOAP #{{ $index + 1 }}</h4>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal & Waktu</label>
                    <p class="text-text-primary">{{ $soapNote->tanggal_waktu ? \Carbon\Carbon::parse($soapNote->tanggal_waktu)->format('d/m/Y H:i') : '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Dokter</label>
                    <p class="text-text-primary">{{ $soapNote->doctor->name ?? '-' }}</p>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">S - Subjective</label>
                    <p class="text-text-primary">{{ $soapNote->subjective ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">O - Objective</label>
                    <p class="text-text-primary">{{ $soapNote->objective ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">A - Assessment</label>
                    <p class="text-text-primary">{{ $soapNote->assessment ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">P - Plan</label>
                    <p class="text-text-primary">{{ $soapNote->plan ?? '-' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Step 7: Resume Pulang -->
    @if($admission->dischargeResume)
    <div class="card mb-6" id="resume-medis-kepulangan">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-blue text-white text-sm font-semibold mr-3">7</div>
            <h3 class="text-lg font-semibold text-text-primary">Resume Pulang</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Pulang</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->tanggal_pulang ? \Carbon\Carbon::parse($admission->dischargeResume->tanggal_pulang)->format('d/m/Y') : '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Kondisi Saat Pulang</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->kondisi_saat_pulang ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Diagnosa Akhir</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->diagnosa_akhir ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Terapi Pulang</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->terapi_pulang ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tindak Lanjut</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->tindak_lanjut ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Edukasi Akhir</label>
                <p class="text-text-primary">{{ $admission->dischargeResume->edukasi_akhir ?? '-' }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 8: Validasi -->
    @if($admission->is_validated)
    <div class="card mb-6" id="validasi">
        <div class="flex items-center mb-4">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-500 text-white text-sm font-semibold mr-3">✓</div>
            <h3 class="text-lg font-semibold text-text-primary">Validasi</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Status Validasi</label>
                <p class="text-green-600 font-medium">Sudah Divalidasi</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Validasi</label>
                <p class="text-text-primary">{{ $admission->validated_at ? \Carbon\Carbon::parse($admission->validated_at)->format('d/m/Y H:i') : '-' }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 mb-1">Log Validasi</label>
                <p class="text-text-primary">{{ $admission->validasi_log ?? '-' }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Dokumen Terlampir -->
    @if($admission->uploadedDocuments->count() > 0)
    <div class="card mb-6">
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-primary-blue mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-lg font-semibold text-text-primary">Dokumen Terlampir</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($admission->uploadedDocuments as $document)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-text-primary">{{ $document->nama_dokumen ?? 'Dokumen' }}</span>
                </div>
                <p class="text-xs text-gray-500">{{ $document->created_at ? \Carbon\Carbon::parse($document->created_at)->format('d/m/Y H:i') : '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Footer Actions -->
    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $admission->created_at ? \Carbon\Carbon::parse($admission->created_at)->format('d/m/Y H:i') : '-' }}
            @if($admission->updated_at && $admission->updated_at != $admission->created_at)
                | Diperbarui: {{ \Carbon\Carbon::parse($admission->updated_at)->format('d/m/Y H:i') }}
            @endif
        </div>
        <div class="flex space-x-3">
            @if(!$admission->is_validated)
                <a href="{{ route('admissions.edit', $admission->id) }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Data
                </a>
            @endif
            <a href="{{ route('admissions.index') }}" class="btn-link gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
