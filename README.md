# Sistem Informasi dan Pelayanan Desa (SID-Lemusa)

Sistem Informasi dan Pelayanan Desa (SID-Lemusa) adalah platform administrasi desa berbasis web yang dibangun untuk memfasilitasi pengelolaan data kependudukan, pengajuan surat menyurat, pelaporan aduan masyarakat, serta publikasi informasi dan potensi desa Lemusa.

---

## Spesifikasi Teknologi

Aplikasi ini dibangun menggunakan tumpukan teknologi modern berikut:

- Framework Backend: Laravel 12
- Panel Administrasi: Filament 5.6
- Otorisasi & Hak Akses: Spatie Laravel Permission 6.25
- Framework Frontend & Interaktivitas: Livewire, Alpine.js, Tailwind CSS
- Database: MySQL / MariaDB

---

## Fitur Utama

### 1. Manajemen Kependudukan
- Pengelolaan data Dusun, Rukun Tetangga (RT), dan Rukun Warga (RW).
- Pengelolaan Kartu Keluarga (KK) dan pencatatan biodata lengkap Penduduk.
- Pencatatan Mutasi Penduduk (kelahiran, kematian, kepindahan, dll).

### 2. Pelayanan Persuratan (Digitalisasi Surat)
- Permohonan surat secara mandiri oleh warga melalui sistem.
- Pemrosesan status permohonan surat secara real-time oleh operator desa.
- Pengaturan template jenis surat secara dinamis.

### 3. Pengaduan Masyarakat
- Warga dapat melaporkan keluhan atau aduan terkait infrastruktur, kebersihan, keamanan, pelayanan desa, atau kategori lainnya.
- Pelacakan status penyelesaian pengaduan oleh operator desa.

### 4. Publikasi Informasi & Potensi Desa
- Pengelolaan artikel berita desa, pengumuman resmi, agenda kegiatan desa, dan dokumentasi galeri kegiatan.
- Publikasi produk unggulan atau potensi desa (UMKM, pertanian, perikanan, dll).

### 5. Dasbor & Statistik Visual
- Grafik demografi penduduk berdasarkan Jenis Kelamin dan Agama.
- Statistik ringkasan jumlah total Penduduk, Kartu Keluarga, Pengajuan Surat, dan Pengaduan aktif.

---

## Keamanan & Kontrol Hak Akses (RBAC)

Aplikasi ini menerapkan Role-Based Access Control yang ketat menggunakan Laravel Policy:

- **Super Admin**: Memiliki kontrol penuh atas seluruh sistem, konfigurasi, data master, serta manajemen akun pengguna dan peran (roles).
- **Kepala Desa**: Memiliki hak akses baca (read-only) untuk memantau data kependudukan, surat menyurat, aduan masyarakat, log aktivitas, dan laporan statistik. Diizinkan melakukan pembaruan profil desa.
- **Operator Desa**: Memiliki hak akses penuh untuk mengelola data kependudukan, menerbitkan informasi/berita, serta memproses pengajuan surat dan pengaduan masyarakat.
- **Warga**: Memiliki hak akses terbatas. Hanya diizinkan mengakses modul pengajuan surat dan aduan masyarakat, serta hanya dapat melihat data yang dibuat oleh akun mereka sendiri.

---

## Kredensial Uji Coba

Gunakan akun berikut untuk masuk ke panel administrasi (semua akun menggunakan sandi: `password`):

| Peran (Role) | Alamat Surel (Email) |
| :--- | :--- |
| Super Admin | superadmin@sid-lemusa.id |
| Kepala Desa | kepaladesa@sid-lemusa.id |
| Operator Desa | operator@sid-lemusa.id |
| Warga | warga@sid-lemusa.id |

---

## Langkah Instalasi & Penggunaan Lokal

### Prasyarat
- PHP 8.2 atau versi terbaru
- Composer
- Node.js & NPM
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

5. **Jalankan Migrasi & Pengisian Data Awal (Seeding)**
   Jalankan perintah berikut untuk membuat struktur database beserta data master, akun uji coba, dan data simulasi demo:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi kini dapat diakses melalui peramban di alamat `http://127.0.0.1:8000/admin`.
