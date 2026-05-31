<?php

namespace Database\Seeders;

use App\Domain\Dusun\Models\Dusun;
use App\Domain\Keluarga\Models\Keluarga;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Pengaduan\Models\Pengaduan;
use App\Domain\Surat\Models\PengajuanSurat;
use App\Domain\PotensiDesa\Models\PotensiDesa;
use App\Domain\PotensiDesa\Models\KategoriPotensi;
use App\Domain\Pengaduan\Models\KategoriPengaduan;
use App\Domain\Berita\Models\Berita;
use App\Domain\Pengumuman\Models\Pengumuman;
use App\Domain\Agenda\Models\Agenda;
use App\Domain\Galeri\Models\Galeri;
use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Dusun ─────────────────────────────────────────────
        $dusun1 = Dusun::firstOrCreate(['nama' => 'Dusun I - Bunga Indah']);
        $dusun2 = Dusun::firstOrCreate(['nama' => 'Dusun II - Melati']);
        $dusun3 = Dusun::firstOrCreate(['nama' => 'Dusun III - Kencana']);

        // ─── Keluarga ──────────────────────────────────────────
        $kk1 = Keluarga::firstOrCreate(
            ['nomor_kk' => '7201020304050001'],
            [
                'dusun_id' => $dusun1->id,
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '001',
                'rw' => '002',
            ]
        );

        $kk2 = Keluarga::firstOrCreate(
            ['nomor_kk' => '7201020304050002'],
            [
                'dusun_id' => $dusun2->id,
                'alamat' => 'Jl. Melati No. 4',
                'rt' => '003',
                'rw' => '002',
            ]
        );

        // ─── Penduduk ──────────────────────────────────────────
        // Link the existing Warga user to a Penduduk record
        $wargaUser = User::where('email', 'warga@sid-lemusa.id')->first();

        $p1 = Penduduk::firstOrCreate(
            ['nik' => '7201021212900001'],
            [
                'nama_lengkap' => 'Ahmad Warga',
                'tempat_lahir' => 'Palu',
                'tanggal_lahir' => '1990-12-12',
                'jenis_kelamin' => 'L',
                'agama_id' => 1, // Islam
                'pendidikan_id' => 6, // S1
                'pekerjaan_id' => 3, // Wiraswasta
                'status_perkawinan_id' => 2, // Kawin
                'keluarga_id' => $kk1->id,
                'no_hp' => '081234567890',
                'email' => 'warga@sid-lemusa.id',
                'status_penduduk' => 'aktif',
                'user_id' => $wargaUser?->id,
            ]
        );

        $p2 = Penduduk::firstOrCreate(
            ['nik' => '7201021405950002'],
            [
                'nama_lengkap' => 'Siti Aminah',
                'tempat_lahir' => 'Luwuk',
                'tanggal_lahir' => '1995-05-14',
                'jenis_kelamin' => 'P',
                'agama_id' => 1,
                'pendidikan_id' => 4, // SMA
                'pekerjaan_id' => 7, // IRT
                'status_perkawinan_id' => 2,
                'keluarga_id' => $kk1->id,
                'no_hp' => '081234567891',
                'email' => 'siti@sid-lemusa.id',
                'status_penduduk' => 'aktif',
            ]
        );

        $p3 = Penduduk::firstOrCreate(
            ['nik' => '7201021908880003'],
            [
                'nama_lengkap' => 'Budi Santoso',
                'tempat_lahir' => 'Poso',
                'tanggal_lahir' => '1988-08-19',
                'jenis_kelamin' => 'L',
                'agama_id' => 2, // Kristen
                'pendidikan_id' => 4,
                'pekerjaan_id' => 1, // Petani
                'status_perkawinan_id' => 2,
                'keluarga_id' => $kk2->id,
                'no_hp' => '081234567892',
                'email' => 'budi@sid-lemusa.id',
                'status_penduduk' => 'aktif',
            ]
        );

        // ─── Pengaduan ─────────────────────────────────────────
        Pengaduan::firstOrCreate(
            ['judul' => 'Jalan Berlubang di Dusun I'],
            [
                'penduduk_id' => $p1->id,
                'kategori_pengaduan_id' => 1, // Infrastruktur
                'isi_laporan' => 'Jalan utama di Dusun I berlubang cukup parah dan membahayakan pengendara motor, mohon segera ditindaklanjuti.',
                'status' => 'baru',
            ]
        );

        Pengaduan::firstOrCreate(
            ['judul' => 'Sampah Menumpuk di Dekat Pasar'],
            [
                'penduduk_id' => $p3->id,
                'kategori_pengaduan_id' => 2, // Kebersihan
                'isi_laporan' => 'Tumpukan sampah di dekat pasar desa sudah mulai mengeluarkan bau tidak sedap karena jarang diangkut.',
                'status' => 'diproses',
            ]
        );

        // ─── Pengajuan Surat ───────────────────────────────────
        PengajuanSurat::firstOrCreate(
            ['kode_pengajuan' => 'SRT-DOMISILI-001'],
            [
                'penduduk_id' => $p1->id,
                'jenis_surat_id' => 1, // Surat Domisili
                'status_surat_id' => 1, // Menunggu Verifikasi
                'estimasi_selesai' => now()->addDays(2),
                'catatan_admin' => null,
            ]
        );

        PengajuanSurat::firstOrCreate(
            ['kode_pengajuan' => 'SRT-UMKM-002'],
            [
                'penduduk_id' => $p1->id,
                'jenis_surat_id' => 2, // Surat Keterangan Usaha
                'status_surat_id' => 3, // Sedang Diproses
                'estimasi_selesai' => now()->addDay(),
                'catatan_admin' => 'Menunggu verifikasi lapangan.',
            ]
        );

        // ─── Potensi Desa ──────────────────────────────────────
        PotensiDesa::firstOrCreate(
            ['nama' => 'Madu Hutan Lemusa'],
            [
                'kategori_potensi_id' => 6, // Produk Unggulan
                'deskripsi' => 'Madu hutan murni yang dipanen langsung dari pohon-pohon di hutan sekitar desa Lemusa.',
            ]
        );

        // ─── Berita ────────────────────────────────────────────
        $adminUser = User::where('email', 'superadmin@sid-lemusa.id')->first();
        Berita::firstOrCreate(
            ['slug' => 'pembangunan-jalan-dusun-i-dimulai'],
            [
                'judul' => 'Pembangunan Jalan Dusun I Dimulai',
                'isi' => 'Pemerintah desa Lemusa secara resmi memulai proyek pengaspalan jalan utama di Dusun I untuk kelancaran transportasi warga.',
                'published_at' => now(),
                'published_by' => $adminUser?->id,
            ]
        );

        // ─── Pengumuman ────────────────────────────────────────
        Pengumuman::firstOrCreate(
            ['judul' => 'Kerja Bakti Massal Desa Lemusa'],
            [
                'isi' => 'Diberitahukan kepada seluruh warga Desa Lemusa bahwa besok hari Minggu pukul 07.00 WITA akan diadakan kerja bakti membersihkan lingkungan desa.',
                'mulai_tampil' => now(),
                'selesai_tampil' => now()->addDays(7),
            ]
        );

        // ─── Agenda ────────────────────────────────────────────
        Agenda::firstOrCreate(
            ['judul' => 'Musyawarah Perencanaan Desa (Musrenbangdes)'],
            [
                'deskripsi' => 'Rapat koordinasi penyusunan Rencana Kerja Pemerintah Desa (RKPDes) tahun anggaran berikutnya.',
                'tanggal_mulai' => now()->addDays(5)->setHour(9)->setMinute(0)->setSecond(0),
                'tanggal_selesai' => now()->addDays(5)->setHour(12)->setMinute(0)->setSecond(0),
                'lokasi' => 'Aula Kantor Desa Lemusa',
            ]
        );

        // ─── Galeri ────────────────────────────────────────────
        Galeri::firstOrCreate(
            ['judul' => 'Penyaluran Bantuan BLT-DD'],
            [
                'tipe' => 'foto',
                'file_url' => 'https://example.com/demo.jpg',
            ]
        );
    }
}
