<?php

namespace Database\Seeders;

use App\Domain\Penduduk\Models\Agama;
use App\Domain\Surat\Models\JenisSurat;
use App\Domain\Pengaduan\Models\KategoriPengaduan;
use App\Domain\PotensiDesa\Models\KategoriPotensi;
use App\Domain\Penduduk\Models\Pekerjaan;
use App\Domain\Penduduk\Models\Pendidikan;
use App\Domain\Penduduk\Models\StatusPerkawinan;
use App\Domain\Surat\Models\StatusSurat;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Agama ─────────────────────────────────────────────
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        foreach ($agamaList as $nama) {
            Agama::firstOrCreate(['nama' => $nama]);
        }

        // ─── Pendidikan ────────────────────────────────────────
        $pendidikanList = ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        foreach ($pendidikanList as $nama) {
            Pendidikan::firstOrCreate(['nama' => $nama]);
        }

        // ─── Pekerjaan ────────────────────────────────────────
        $pekerjaanList = [
            'Petani', 'Nelayan', 'Wiraswasta', 'ASN', 'Mahasiswa',
            'Pelajar', 'Ibu Rumah Tangga', 'Buruh', 'Pedagang',
            'Tidak Bekerja', 'Lainnya',
        ];
        foreach ($pekerjaanList as $nama) {
            Pekerjaan::firstOrCreate(['nama' => $nama]);
        }

        // ─── Status Perkawinan ─────────────────────────────────
        $statusPerkawinanList = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        foreach ($statusPerkawinanList as $nama) {
            StatusPerkawinan::firstOrCreate(['nama' => $nama]);
        }

        // ─── Jenis Surat ──────────────────────────────────────
        $jenisSuratList = [
            ['nama' => 'Surat Domisili', 'deskripsi' => 'Surat keterangan domisili/tempat tinggal'],
            ['nama' => 'Surat Keterangan Usaha', 'deskripsi' => 'Surat keterangan usaha bagi pelaku UMKM'],
            ['nama' => 'Surat Tidak Mampu', 'deskripsi' => 'Surat keterangan tidak mampu untuk keperluan bantuan'],
            ['nama' => 'Surat Pengantar SKCK', 'deskripsi' => 'Surat pengantar untuk pembuatan SKCK'],
            ['nama' => 'Surat Kelahiran', 'deskripsi' => 'Surat keterangan kelahiran dari desa'],
            ['nama' => 'Surat Kematian', 'deskripsi' => 'Surat keterangan kematian dari desa'],
            ['nama' => 'Surat Pindah', 'deskripsi' => 'Surat keterangan pindah domisili'],
        ];
        foreach ($jenisSuratList as $data) {
            JenisSurat::firstOrCreate(['nama' => $data['nama']], $data);
        }

        // ─── Status Surat ─────────────────────────────────────
        $statusSuratList = [
            'Menunggu Verifikasi',
            'Data Tidak Lengkap',
            'Sedang Diproses',
            'Menunggu Tanda Tangan',
            'Selesai',
            'Ditolak',
        ];
        foreach ($statusSuratList as $nama) {
            StatusSurat::firstOrCreate(['nama' => $nama]);
        }

        // ─── Kategori Pengaduan ────────────────────────────────
        $kategoriPengaduanList = [
            'Infrastruktur', 'Kebersihan', 'Keamanan',
            'Bantuan Sosial', 'Pelayanan Desa', 'Lainnya',
        ];
        foreach ($kategoriPengaduanList as $nama) {
            KategoriPengaduan::firstOrCreate(['nama' => $nama]);
        }

        // ─── Kategori Potensi Desa ─────────────────────────────
        $kategoriPotensiList = [
            'UMKM', 'Pertanian', 'Perikanan',
            'Peternakan', 'Wisata', 'Produk Unggulan',
        ];
        foreach ($kategoriPotensiList as $nama) {
            KategoriPotensi::firstOrCreate(['nama' => $nama]);
        }
    }
}
