# Sistem Informasi dan Pelayanan Desa (SID-Lemusa)

Sistem Informasi dan Pelayanan Desa (SID-Lemusa) adalah platform administrasi desa berbasis web yang dibangun dengan pendekatan Clean Architecture Lite untuk memfasilitasi pengelolaan data kependudukan, pengajuan surat menyurat, pelaporan aduan masyarakat, serta publikasi informasi dan potensi desa Lemusa.

---

## Spesifikasi Teknologi

Aplikasi ini dibangun menggunakan tumpukan teknologi modern berikut:

- Framework Backend: Laravel 12
- Panel Administrasi: Filament 5.6
- Otorisasi dan Hak Akses: Spatie Laravel Permission 6.25
- Framework Frontend dan Interaktivitas: Livewire, Alpine.js, Tailwind CSS
- Database: MySQL / MariaDB

---

## Desain Arsitektur (Clean Architecture Lite)

Sistem ini dirancang menggunakan pendekatan Clean Architecture Lite yang memisahkan aplikasi menjadi beberapa lapisan terstruktur untuk kemudahan pemeliharaan dan pengujian:

1. **Presentation Layer (Lapisan Presentasi)**
   - Lokasi: `app/Filament/`
   - Tanggung jawab: Mengelola antarmuka pengguna admin, formulir input, tabel data, widget statistik, dan kontrol tampilan Filament. Lapisan ini didekopel sepenuhnya dari logika bisnis database langsung.

2. **Application Layer (Lapisan Aplikasi)**
   - Lokasi: `app/Domain/*/Actions/`, `app/Domain/*/DTOs/`, `app/Domain/*/Services/`
   - Tanggung jawab: Mengatur aliran logika aplikasi, mendefinisikan Data Transfer Object (DTO) untuk validasi data masukan, serta menjalankan prosedur aksi bisnis (Actions) yang bersifat modular dan independen dari framework UI.

3. **Domain Layer (Lapisan Domain)**
   - Lokasi: `app/Domain/*/Models/`, `app/Domain/*/Policies/`, `app/Domain/*/Enums/`
   - Tanggung jawab: Menyimpan aturan bisnis inti, entitas basis data (Eloquent Models), kebijakan otorisasi hak akses (Policies), dan enumerasi tipe data terstruktur (Backed Enums).

4. **Infrastructure Layer (Lapisan Infrastruktur)**
   - Lokasi: `database/migrations/`, konfigurasi sistem, dan integrasi pihak ketiga.
   - Tanggung jawab: Menyediakan detail teknis penyimpanan basis data, migrasi skema tabel, dan implementasi layanan eksternal.

---

## Kredensial Uji Coba

Gunakan akun berikut untuk masuk ke panel administrasi (semua akun menggunakan sandi: password):

| Peran (Role) | Alamat Surel (Email) |
| :--- | :--- |
| Super Admin | superadmin@sid-lemusa.id |
| Kepala Desa | kepaladesa@sid-lemusa.id |
| Operator Desa | operator@sid-lemusa.id |
| Warga | warga@sid-lemusa.id |

---

## Langkah Instalasi dan Penggunaan Lokal

### Prasyarat
- PHP 8.2 atau versi terbaru
- Composer
- Node.js dan NPM
- MySQL / MariaDB

### Panduan Langkah demi Langkah

1. **Klon Repositori**
   ```bash
   git clone <repository-url>
   cd SID-Lemusa
   ```

2. **Instal Dependensi PHP**
   ```bash
   composer install
   ```

3. **Salin dan Konfigurasi Environment**
   Salin berkas `.env.example` menjadi `.env` lalu sesuaikan kredensial koneksi database Anda:
   ```bash
   cp .env.example .env
   ```

4. **Buat Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi dan Pengisian Data Awal (Seeding)**
   Jalankan perintah berikut untuk membuat struktur database beserta data master, akun uji coba, dan data simulasi demo:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi kini dapat diakses melalui peramban di alamat `http://127.0.0.1:8000/admin`.
