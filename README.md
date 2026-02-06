# PIKSI GANESHA HOSPITAL - Refactoring Project

**Project:** Pengembangan Sistem Informasi Manajemen Rumah Sakit (Inpatient Admission)  
**Group:** Dakode  
**Status:** Refactoring Complete

---

## 📖 Deskripsi Proyek
Proyek ini bertujuan untuk melakukan refactoring pada modul **Rawat Inap (Inpatient Admission)** di RS Piksi Ganesha. Kode awal (Legacy Code) memiliki masalah "God Class" pada `InpatientAdmissionController.php` (328 baris), yang melanggar prinsip *Single Responsibility* dan sulit untuk dikembangkan.

Tim kami telah memecah kode monolitik ini menggunakan **12 Design Patterns** (4 Creational, 4 Structural, 4 Behavioral) untuk mencapai arsitektur yang:
- **Modular:** Pemisahan tanggung jawab yang jelas.
- **Maintainable:** Mudah dikelola dan di-update.
- **Extensible:** Mudah ditambah fitur baru tanpa merusak kode lama.

---

## 📂 Struktur Direktori Refactoring

Kode hasil refactoring tersimpan dalam direktori `app/Patterns`:

```text
app/Patterns/
├── Behavioral/
│   ├── Observer/   # Logika Notifikasi & Logging
│   ├── State/      # Logika Status Pasien
│   ├── Strategy/   # Logika Pemulangan Pasien
│   └── Template/   # Logika Laporan Medis
├── Creational/
│   ├── Builder/    # Logika Pembuatan Objek Admission
│   ├── Factory/    # Logika Pembuatan Dokumen Medis
│   ├── Prototype/  # Logika Cloning Clinical Pathway
│   └── Singleton/  # Konfigurasi Global Aplikasi
└── Structural/
    ├── Adapter/    # Integrasi BPJS/Asuransi
    ├── Decorator/  # Logika Billing/Tagihan
    ├── Facade/     # Pintu Masuk Registrasi Pasien
    └── Proxy/      # Keamanan Akses Data
```

---

## 🔄 Cara Membandingkan (Before vs After)

Kami telah menyimpan kode asli (Legacy) untuk tujuan perbandingan.

### 1. The "Before" Code (Legacy)
Lihat betapa kompleks dan berantakannya kode asli (328 lines, God Class):
👉 **[legacy/InpatientAdmissionController_Original.php](legacy/InpatientAdmissionController_Original.php)**

### 2. The "After" Code (Refactored)
Lihat bagaimana kode tersebut dipecah menjadi pola-pola yang bersih di direktori:
👉 **[app/Patterns/](app/Patterns/)**

Sebagai contoh, logika validasi BPJS yang tercampur di controller lama kini terisolasi rapi di `app/Patterns/Structural/Adapter/BPJSAdapter.php`.

---

*Dibuat oleh Kelompok Dakode untuk Tugas Besar Mata Kuliah Design Pattern.*
