@extends('layouts.app')

@section('title', 'Tambah Pasien Baru - RME Rawat Inap')
@section('page-title', 'Tambah Pasien Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Progress Indicator -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            @for($i = 1; $i <= 8; $i++)
                <div class="flex items-center">
                    <div id="step-indicator-{{ $i }}" class="flex items-center justify-center w-8 h-8 rounded-full border-2 {{ $i <= 1 ? 'bg-primary-blue border-primary-blue text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                        {{ $i }}
                    </div>
                    @if($i < 8)
                        <div id="step-line-{{ $i }}" class="w-16 h-0.5 {{ $i < 1 ? 'bg-primary-blue' : 'bg-gray-300' }}"></div>
                    @endif
                </div>
            @endfor
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-600">
            <span>Data Awal</span>
            <span>Identitas</span>
            <span>Klinis</span>
            <span>Keperawatan</span>
            <span>Farmasi</span>
            <span>SOAP</span>
            <span>Pulang</span>
            <span>Validasi</span>
        </div>
    </div>

    <!-- Multi-Step Form -->
    <form id="admissionForm" method="POST" action="{{ route('admissions.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        
        <!-- Step 1: Initial Data -->
        <div id="step1" class="step-content">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 1: Data Awal</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="id_rekam_medis" class="block text-sm font-medium text-gray-700 mb-2">Nomor RM</label>
                        <input type="text" id="id_rekam_medis" name="step1[id_rekam_medis]" class="input-field w-full" placeholder="RM-XXXXX (auto-generated if empty)">
                    </div>
                    
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Pasien</label>
                        <input type="text" id="nama" name="step1[nama]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select id="kelas" name="step1[kelas]" class="input-field w-full" required>
                            <option value="">Pilih Kelas</option>
                            <option value="VIP">VIP</option>
                            <option value="I">Kelas I</option>
                            <option value="II">Kelas II</option>
                            <option value="III">Kelas III</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">Dokter Penanggung Jawab</label>
                        <select id="doctor_id" name="step1[doctor_id]" class="input-field w-full" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->nama_dokter }} - {{ $doctor->spesialisasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Patient Identity -->
        <div id="step2" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 2: Identitas Pasien</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="step2[nama_lengkap]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK/BPJS</label>
                        <input type="text" id="nik" name="step2[nik]" class="input-field w-full" required maxlength="16">
                    </div>
                    
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="step2[jenis_kelamin]" class="input-field w-full" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="step2[tanggal_lahir]" class="input-field w-full" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="step2[alamat]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="tel" id="telepon" name="step2[telepon]" class="input-field w-full">
                    </div>
                    
                    <div>
                        <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                        <input type="text" id="penanggung_jawab" name="step2[penanggung_jawab]" class="input-field w-full">
                    </div>
                    
                    <div>
                        <label for="kontak_darurat" class="block text-sm font-medium text-gray-700 mb-2">Kontak Darurat</label>
                        <input type="tel" id="kontak_darurat" name="step2[kontak_darurat]" class="input-field w-full">
                    </div>
                    
                    <div>
                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                        <input type="date" id="tanggal_masuk" name="step2[tanggal_masuk]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="waktu_masuk" class="block text-sm font-medium text-gray-700 mb-2">Waktu Masuk</label>
                        <input type="time" id="waktu_masuk" name="step2[waktu_masuk]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="ruangan_kelas" class="block text-sm font-medium text-gray-700 mb-2">Ruangan/Kelas</label>
                        <input type="text" id="ruangan_kelas" name="step2[ruangan_kelas]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="no_kamar" class="block text-sm font-medium text-gray-700 mb-2">No. Kamar</label>
                        <input type="text" id="no_kamar" name="step2[no_kamar]" class="input-field w-full" required>
                    </div>
                    
                    <div>
                        <label for="diagnosa_awal" class="block text-sm font-medium text-gray-700 mb-2">Diagnosa Awal</label>
                        <input type="text" id="diagnosa_awal" name="step2[diagnosa_awal]" class="input-field w-full">
                    </div>
                    
                    <div>
                        <label for="jenis_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pembayaran</label>
                        <select id="jenis_pembayaran" name="step2[jenis_pembayaran]" class="input-field w-full" required>
                            <option value="">Pilih Jenis Pembayaran</option>
                            <option value="Umum">Umum</option>
                            <option value="BPJS">BPJS</option>
                            <option value="Asuransi Swasta">Asuransi Swasta</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="no_surat_jaminan" class="block text-sm font-medium text-gray-700 mb-2">No. Surat Jaminan</label>
                        <input type="text" id="no_surat_jaminan" name="step2[no_surat_jaminan]" class="input-field w-full">
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Clinical Data -->
        <div id="step3" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 3: Data Klinis Awal Dokter</h3>
                
                <div class="space-y-6">
                    <div>
                        <label for="keluhan_utama" class="block text-sm font-medium text-gray-700 mb-2">Keluhan Utama</label>
                        <textarea id="keluhan_utama" name="step3[keluhan_utama]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="riwayat_penyakit_sekarang" class="block text-sm font-medium text-gray-700 mb-2">Riwayat Penyakit Sekarang</label>
                        <textarea id="riwayat_penyakit_sekarang" name="step3[riwayat_penyakit_sekarang]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="riwayat_penyakit_dahulu" class="block text-sm font-medium text-gray-700 mb-2">Riwayat Penyakit Dahulu</label>
                        <textarea id="riwayat_penyakit_dahulu" name="step3[riwayat_penyakit_dahulu]" class="input-field w-full" rows="3"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="tinggi_badan" class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan (cm)</label>
                            <input type="number" id="tinggi_badan" name="step3[tinggi_badan]" class="input-field w-full" min="50" max="250">
                        </div>
                        
                        <div>
                            <label for="berat_badan" class="block text-sm font-medium text-gray-700 mb-2">Berat Badan (kg)</label>
                            <input type="number" id="berat_badan" name="step3[berat_badan]" class="input-field w-full" min="1" max="500">
                        </div>
                        
                        <div>
                            <label for="suhu_tubuh" class="block text-sm font-medium text-gray-700 mb-2">Suhu Tubuh (°C)</label>
                            <input type="number" id="suhu_tubuh" name="step3[ttv][suhu_tubuh]" class="input-field w-full" step="0.1" min="30" max="45">
                        </div>
                        
                        <div>
                            <label for="tekanan_darah" class="block text-sm font-medium text-gray-700 mb-2">Tekanan Darah (mmHg)</label>
                            <input type="text" id="tekanan_darah" name="step3[ttv][tekanan_darah]" class="input-field w-full" placeholder="120/80">
                        </div>
                        
                        <div>
                            <label for="nadi" class="block text-sm font-medium text-gray-700 mb-2">Nadi (bpm)</label>
                            <input type="number" id="nadi" name="step3[ttv][nadi]" class="input-field w-full" min="30" max="200">
                        </div>
                        
                        <div>
                            <label for="pernapasan" class="block text-sm font-medium text-gray-700 mb-2">Pernapasan (rpm)</label>
                            <input type="number" id="pernapasan" name="step3[ttv][pernapasan]" class="input-field w-full" min="5" max="50">
                        </div>
                    </div>
                    
                    <div>
                        <label for="hasil_pemeriksaan_penunjang" class="block text-sm font-medium text-gray-700 mb-2">Hasil Pemeriksaan Penunjang</label>
                        <textarea id="hasil_pemeriksaan_penunjang" name="step3[hasil_pemeriksaan_penunjang]" class="input-field w-full" rows="3"></textarea>
                    </div>
                    
                    <div>
                        <label for="diagnosa_kerja" class="block text-sm font-medium text-gray-700 mb-2">Diagnosa Kerja</label>
                        <div class="">
                            <label for="diagnosa_kerja_icd10" class="block ml-2 text-sm font-medium text-gray-700 mb-2">ICD-10</label>
                            <select id="diagnosa_kerja_icd10" name="step3[diagnosa_kerja]" class="input-field w-full">
                                <option value="">Pilih Diagnosa</option>
                                @foreach($icd10Codes as $code)
                                    <option value="{{ $code->code }}">{{ $code->code }} - {{ $code->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                        <div class="">
                            <label for="diagnosa_kerja_icd9" class="block ml-2 text-sm font-medium text-gray-700 mb-2 mt-2">ICD-9</label>
                            <select id="diagnosa_kerja_icd9" name="step3[diagnosa_kerja_icd9]" class="input-field w-full">
                                <option value="">Pilih Diagnosa</option>
                                @foreach($icd9Codes as $code)
                                    <option value="{{ $code->code }}">{{ $code->code }} - {{ $code->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="diagnosa_banding" class="block text-sm font-medium text-gray-700 mb-2">Diagnosa Banding</label>
                        <div class="">
                            <label for="diagnosa_banding_icd10" class="block ml-2 text-sm font-medium text-gray-700 mb-2">ICD-10</label>
                            <select id="diagnosa_banding_icd10" name="step3[diagnosa_banding]" class="input-field w-full">
                                <option value="">Pilih Diagnosa</option>
                                @foreach($icd10Codes as $code)
                                    <option value="{{ $code->code }}">{{ $code->code }} - {{ $code->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="">
                            <label for="diagnosa_banding_icd9" class="block ml-2 text-sm font-medium text-gray-700 mb-2 mt-2">ICD-9</label>
                            <select id="diagnosa_banding_icd9" name="step3[diagnosa_banding_icd9]" class="input-field w-full">
                                <option value="">Pilih Diagnosa</option>
                                @foreach($icd9Codes as $code)
                                    <option value="{{ $code->code }}">{{ $code->code }} - {{ $code->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="file_pemeriksaan" class="block text-sm font-medium text-gray-700 mb-2">File Pemeriksaan Penunjang</label>
                        <input type="file" id="file_pemeriksaan" name="step3[file_pemeriksaan]" class="input-field w-full" accept=".pdf,.jpg,.jpeg,.png,.docx">
                        <p class="text-xs text-gray-500 mt-1">Format yang didukung: PDF, JPG, PNG, DOCX (Max: 5MB)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Nursing Notes -->
        <div id="step4" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 4: Catatan Keperawatan</h3>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_waktu_keperawatan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu</label>
                            <input type="datetime-local" id="tanggal_waktu_keperawatan" name="step4[tanggal_waktu]" class="input-field w-full" required>
                        </div>
                        
                        <div>
                            <label for="frekuensi_durasi" class="block text-sm font-medium text-gray-700 mb-2">Frekuensi & Durasi</label>
                            <select id="frekuensi_durasi" name="step4[frekuensi_durasi]" class="input-field w-full" required>
                                <option value="">Pilih Frekuensi</option>
                                <option value="1x/hari">1x/hari</option>
                                <option value="2x/hari">2x/hari</option>
                                <option value="3x/hari">3x/hari</option>
                                <option value="4x/hari">4x/hari</option>
                                <option value="Sesuai kebutuhan">Sesuai kebutuhan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="tujuan_keperawatan" class="block text-sm font-medium text-gray-700 mb-2">Tujuan Keperawatan</label>
                        <textarea id="tujuan_keperawatan" name="step4[tujuan_keperawatan]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="intervensi_keperawatan" class="block text-sm font-medium text-gray-700 mb-2">Intervensi Keperawatan</label>
                        <textarea id="intervensi_keperawatan" name="step4[intervensi_keperawatan]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="petugas_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Petugas Penanggung Jawab</label>
                        <input type="text" id="petugas_penanggung_jawab" name="step4[petugas_penanggung_jawab]" class="input-field w-full" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5: Pharmacy & Medical Actions -->
        <div id="step5" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 5: Data Farmasi & Tindakan</hx>
                
                <!-- Pharmacy Section -->
                <div class="mb-8">
                    <h4 class="text-md font-semibold text-text-primary mb-4">Data Obat</h4>
                    <div id="pharmacy-container">
                        <div class="pharmacy-item border border-gray-300 rounded-lg p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Obat</label>
                                    <select name="step5_pharmacy[0][nama_obat]" class="input-field w-full" required>
                                        <option value="">Pilih Obat</option>
                                        @foreach($medications as $med)
                                            <option value="{{ $med->nama_obat }}">{{ $med->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dosis & Frekuensi</label>
                                    <input type="text" name="step5_pharmacy[0][dosis_frekuensi]" class="input-field w-full" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rak Pemberian</label>
                                    <input type="text" name="step5_pharmacy[0][rak_pemberian]" class="input-field w-full">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Pemberian</label>
                                    <input type="time" name="step5_pharmacy[0][waktu_pemberian]" class="input-field w-full">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="step5_pharmacy[0][status]" class="input-field w-full" required>
                                        <option value="Belum">Belum</option>
                                        <option value="Sudah">Sudah</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Obat Lanjutan</label>
                                    <textarea name="step5_pharmacy[0][catatan_obat_lanjutan]" class="input-field w-full" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-pharmacy" class="btn-secondary">Tambah Obat</button>
                </div>
                
                <!-- Medical Actions Section -->
                <div>
                    <h4 class="text-md font-semibold text-text-primary mb-4">Tindakan Medis</h4>
                    <div id="actions-container">
                        <div class="action-item border border-gray-300 rounded-lg p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Tindakan</label>
                                    <select name="step5_actions[0][jenis_tindakan]" class="input-field w-full" required>
                                        <option value="">Pilih Jenis Tindakan</option>
                                        <option value="Operasi">Operasi</option>
                                        <option value="Pemeriksaan">Pemeriksaan</option>
                                        <option value="Prosedur">Prosedur</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                    <input type="datetime-local" name="step5_actions[0][tanggal]" class="input-field w-full" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokter Operator</label>
                                    <select name="step5_actions[0][dokter_operator_id]" class="input-field w-full" required>
                                        <option value="">Pilih Dokter</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Perawat Pendamping</label>
                                    <select name="step5_actions[0][perawat_pendamping_id]" class="input-field w-full" required>
                                        <option value="">Pilih Perawat</option>
                                        @foreach($nurses as $nurse)
                                            <option value="{{ $nurse->id }}">{{ $nurse->nama_perawat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Tindakan</label>
                                    <textarea name="step5_actions[0][ringkasan_tindakan]" class="input-field w-full" rows="3" required></textarea>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Komplikasi</label>
                                    <textarea name="step5_actions[0][komplikasi]" class="input-field w-full" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-action" class="btn-secondary">Tambah Tindakan</button>
                </div>
            </div>
        </div>

        <!-- Step 6: SOAP Notes -->
        <div id="step6" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 6: Catatan Dokter Harian (SOAP)</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu</label>
                        <input type="datetime-local" name="step6[tanggal_waktu]" class="input-field w-full" value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                    </div>
                    
                    <div>
                        <label for="subjective" class="block text-sm font-medium text-gray-700 mb-2">S - Subjective (Keluhan Subjektif)</label>
                        <textarea id="subjective" name="step6[subjective]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="objective" class="block text-sm font-medium text-gray-700 mb-2">O - Objective (Temuan Objektif)</label>
                        <textarea id="objective" name="step6[objective]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="assessment" class="block text-sm font-medium text-gray-700 mb-2">A - Assessment (Penilaian)</label>
                        <textarea id="assessment" name="step6[assessment]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="plan" class="block text-sm font-medium text-gray-700 mb-2">P - Plan (Rencana)</label>
                        <textarea id="plan" name="step6[plan]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="tanda_tangan_digital" class="block text-sm font-medium text-gray-700 mb-2">Tanda Tangan Digital</label>
                        <input type="text" id="tanda_tangan_digital" name="step6[tanda_tangan_digital]" class="input-field w-full" placeholder="Nama lengkap dokter">
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 7: Discharge Summary -->
        <div id="step7" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 7: Resume Medis & Kepulangan</h3>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_pulang" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pulang</label>
                            <input type="date" id="tanggal_pulang" name="step7[tanggal_pulang]" class="input-field w-full" required>
                        </div>
                        
                        <div>
                            <label for="kondisi_saat_pulang" class="block text-sm font-medium text-gray-700 mb-2">Kondisi Saat Pulang</label>
                            <select id="kondisi_saat_pulang" name="step7[kondisi_saat_pulang]" class="input-field w-full" required>
                                <option value="">Pilih Kondisi</option>
                                <option value="Sembuh">Sembuh</option>
                                <option value="Membaik">Membaik</option>
                                <option value="Dirujuk">Dirujuk</option>
                                <option value="Meninggal">Meninggal</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="diagnosa_akhir" class="block text-sm font-medium text-gray-700 mb-2">Diagnosa Akhir (ICD-10)</label>
                        <select id="diagnosa_akhir" name="step7[diagnosa_akhir]" class="input-field w-full" required>
                            <option value="">Pilih Diagnosa</option>
                            @foreach($icd10Codes as $code)
                                <option value="{{ $code->code }}">{{ $code->code }} - {{ $code->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="terapi_pulang" class="block text-sm font-medium text-gray-700 mb-2">Terapi Pulang</label>
                        <textarea id="terapi_pulang" name="step7[terapi_pulang]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="tindak_lanjut" class="block text-sm font-medium text-gray-700 mb-2">Tindak Lanjut</label>
                        <textarea id="tindak_lanjut" name="step7[tindak_lanjut]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div>
                        <label for="edukasi_akhir" class="block text-sm font-medium text-gray-700 mb-2">Edukasi Akhir</label>
                        <textarea id="edukasi_akhir" name="step7[edukasi_akhir]" class="input-field w-full" rows="3" required></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanda_tangan_perawat" class="block text-sm font-medium text-gray-700 mb-2">Tanda Tangan Perawat</label>
                            <input type="text" id="tanda_tangan_perawat" name="step7[tanda_tangan_perawat]" class="input-field w-full">
                        </div>
                        
                        <div>
                            <label for="tanda_tangan_dokter" class="block text-sm font-medium text-gray-700 mb-2">Tanda Tangan Dokter</label>
                            <input type="text" id="tanda_tangan_dokter" name="step7[tanda_tangan_dokter]" class="input-field w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 8: Validation -->
        <div id="step8" class="step-content hidden">
            <div class="card">
                <h3 class="text-lg font-semibold text-text-primary mb-6">Step 8: Validasi</h3>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Petugas Input</label>
                            <input type="text" class="input-field w-full" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu Entri</label>
                            <input type="text" class="input-field w-full" value="{{ now()->format('d/m/Y H:i:s') }}" readonly>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Revisi Terakhir</label>
                        <input type="text" class="input-field w-full" value="{{ now()->format('d/m/Y H:i:s') }}" readonly>
                    </div>
                    
                    <div>
                        <label for="validasi_log" class="block text-sm font-medium text-gray-700 mb-2">Log Aktivitas</label>
                        <textarea id="validasi_log" name="step8[validasi_log]" class="input-field w-full" rows="4" placeholder="Catatan validasi dan perubahan data..."></textarea>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="confirm_validation" name="step8[validate]" value="1" class="mr-2">
                        <label for="confirm_validation" class="text-sm text-gray-700">Saya menyatakan bahwa data yang diinput sudah benar dan lengkap</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-8">
            <button type="button" id="prevBtn" class="btn-ghost" onclick="changeStep(-1)" style="display: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Sebelumnya
            </button>
            
            <button type="button" id="nextBtn" class="btn-primary" onclick="changeStep(1)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                Selanjutnya
            </button>
            
            <button type="submit" id="submitBtn" class="btn-primary" style="display: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Data
            </button>
        </div>
    </form>
</div>

<script>
let currentStep = 1;
const totalSteps = 8;

function changeStep(direction) {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    currentStepElement.classList.add('hidden');
    
    currentStep += direction;
    
    const newStepElement = document.getElementById(`step${currentStep}`);
    newStepElement.classList.remove('hidden');
    
    // Update progress indicator
    updateProgressIndicator();
    
    // Update buttons
    updateButtons();
}

function updateProgressIndicator() {
    for (let i = 1; i <= totalSteps; i++) {
        // Use unique IDs for reliable targeting
        const indicator = document.getElementById(`step-indicator-${i}`);
        const line = document.getElementById(`step-line-${i}`);
        
        // Skip if elements not found (safety check)
        if (!indicator) {
            console.warn(`Step ${i} indicator not found`);
            continue;
        }
        
        // Remove all existing classes first to ensure clean state
        indicator.classList.remove('bg-primary-blue', 'border-primary-blue', 'text-white', 'bg-white', 'border-gray-300', 'text-gray-500', 'ring-2', 'ring-primary-blue', 'ring-offset-2');
        
        if (i < currentStep) {
            // COMPLETED STEPS: Solid blue background (no ring)
            // Example: When on Step 3, Steps 1-2 are completed
            indicator.classList.add('bg-primary-blue', 'border-primary-blue', 'text-white');
            if (line) {
                line.classList.add('bg-primary-blue');
                line.classList.remove('bg-gray-300');
            }
        } else if (i === currentStep) {
            // ACTIVE STEP: Blue background + ring effect for emphasis
            // Example: When on Step 3, Step 3 is active
            indicator.classList.add('bg-primary-blue', 'border-primary-blue', 'text-white', 'ring-2', 'ring-primary-blue', 'ring-offset-2');
            if (line) {
                line.classList.add('bg-primary-blue');
                line.classList.remove('bg-gray-300');
            }
        } else {
            // FUTURE STEPS: Gray/white background
            // Example: When on Step 3, Steps 4-8 are future
            indicator.classList.add('bg-white', 'border-gray-300', 'text-gray-500');
            if (line) {
                line.classList.remove('bg-primary-blue');
                line.classList.add('bg-gray-300');
            }
        }
    }
}

function updateButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    if (currentStep === 1) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'inline-flex';
    }
    
    if (currentStep === totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'inline-flex';
    } else {
        nextBtn.style.display = 'inline-flex';
        submitBtn.style.display = 'none';
    }
}

// Pharmacy and Actions dynamic forms
let pharmacyCount = 1;
let actionCount = 1;

document.getElementById('add-pharmacy').addEventListener('click', function() {
    const container = document.getElementById('pharmacy-container');
    const newItem = document.querySelector('.pharmacy-item').cloneNode(true);
    
    // Update input names with new index
    newItem.querySelectorAll('input, select, textarea').forEach(input => {
        const name = input.getAttribute('name');
        if (name) {
            input.setAttribute('name', name.replace('[0]', `[${pharmacyCount}]`));
            input.value = '';
        }
    });
    
    container.appendChild(newItem);
    pharmacyCount++;
});

document.getElementById('add-action').addEventListener('click', function() {
    const container = document.getElementById('actions-container');
    const newItem = document.querySelector('.action-item').cloneNode(true);
    
    // Update input names with new index
    newItem.querySelectorAll('input, select, textarea').forEach(input => {
        const name = input.getAttribute('name');
        if (name) {
            input.setAttribute('name', name.replace('[0]', `[${actionCount}]`));
            input.value = '';
        }
    });
    
    container.appendChild(newItem);
    actionCount++;
});

// Function to show a specific step (for direct navigation if needed)
function showStep(stepNumber) {
    // Hide all steps
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById(`step${i}`).classList.add('hidden');
    }
    
    // Show the target step
    document.getElementById(`step${stepNumber}`).classList.remove('hidden');
    
    // Update current step
    currentStep = stepNumber;
    
    // Update progress indicator and buttons
    updateProgressIndicator();
    updateButtons();
}

// Initialize
updateProgressIndicator();
updateButtons();
</script>
@endsection
