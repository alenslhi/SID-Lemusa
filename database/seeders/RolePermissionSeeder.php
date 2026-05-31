<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ─── Create Permissions ────────────────────────────────

        $permissions = [
            // Penduduk
            'lihat_penduduk', 'tambah_penduduk', 'edit_penduduk', 'hapus_penduduk',
            // Keluarga
            'lihat_keluarga', 'tambah_keluarga', 'edit_keluarga', 'hapus_keluarga',
            // Dusun
            'lihat_dusun', 'tambah_dusun', 'edit_dusun', 'hapus_dusun',
            // Master Data
            'kelola_master_data',
            // Mutasi Penduduk
            'lihat_mutasi', 'tambah_mutasi',
            // Surat
            'lihat_surat', 'ajukan_surat', 'proses_surat', 'hapus_surat',
            // Pengaduan
            'lihat_pengaduan', 'ajukan_pengaduan', 'proses_pengaduan', 'hapus_pengaduan',
            // Berita
            'lihat_berita', 'tambah_berita', 'edit_berita', 'hapus_berita',
            // Pengumuman
            'lihat_pengumuman', 'tambah_pengumuman', 'edit_pengumuman', 'hapus_pengumuman',
            // Agenda
            'lihat_agenda', 'tambah_agenda', 'edit_agenda', 'hapus_agenda',
            // Galeri
            'lihat_galeri', 'tambah_galeri', 'edit_galeri', 'hapus_galeri',
            // Potensi Desa
            'lihat_potensi', 'tambah_potensi', 'edit_potensi', 'hapus_potensi',
            // Profil Desa
            'lihat_profil_desa', 'edit_profil_desa',
            // Perangkat Desa
            'lihat_perangkat_desa', 'tambah_perangkat_desa', 'edit_perangkat_desa', 'hapus_perangkat_desa',
            // User Management
            'lihat_user', 'tambah_user', 'edit_user', 'hapus_user',
            // Roles
            'lihat_role', 'kelola_role',
            // Activity Log
            'lihat_activity_log',
            // Notification
            'lihat_notifikasi',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ─── Create Roles ──────────────────────────────────────

        // Super Admin — gets ALL permissions automatically via Gate::before
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);

        // Kepala Desa — can view everything, manage profil & perangkat
        $kepalaDesa = Role::firstOrCreate(['name' => 'Kepala Desa']);
        $kepalaDesa->syncPermissions([
            'lihat_penduduk', 'lihat_keluarga', 'lihat_dusun',
            'lihat_mutasi',
            'lihat_surat', 'proses_surat',
            'lihat_pengaduan', 'proses_pengaduan',
            'lihat_berita', 'lihat_pengumuman', 'lihat_agenda', 'lihat_galeri',
            'lihat_potensi',
            'lihat_profil_desa', 'edit_profil_desa',
            'lihat_perangkat_desa', 'tambah_perangkat_desa', 'edit_perangkat_desa', 'hapus_perangkat_desa',
            'lihat_user',
            'lihat_activity_log',
            'lihat_notifikasi',
        ]);

        // Operator Desa — full CRUD on most data
        $operator = Role::firstOrCreate(['name' => 'Operator Desa']);
        $operator->syncPermissions([
            'lihat_penduduk', 'tambah_penduduk', 'edit_penduduk', 'hapus_penduduk',
            'lihat_keluarga', 'tambah_keluarga', 'edit_keluarga', 'hapus_keluarga',
            'lihat_dusun', 'tambah_dusun', 'edit_dusun', 'hapus_dusun',
            'kelola_master_data',
            'lihat_mutasi', 'tambah_mutasi',
            'lihat_surat', 'proses_surat', 'hapus_surat',
            'lihat_pengaduan', 'proses_pengaduan', 'hapus_pengaduan',
            'lihat_berita', 'tambah_berita', 'edit_berita', 'hapus_berita',
            'lihat_pengumuman', 'tambah_pengumuman', 'edit_pengumuman', 'hapus_pengumuman',
            'lihat_agenda', 'tambah_agenda', 'edit_agenda', 'hapus_agenda',
            'lihat_galeri', 'tambah_galeri', 'edit_galeri', 'hapus_galeri',
            'lihat_potensi', 'tambah_potensi', 'edit_potensi', 'hapus_potensi',
            'lihat_profil_desa', 'edit_profil_desa',
            'lihat_perangkat_desa', 'tambah_perangkat_desa', 'edit_perangkat_desa', 'hapus_perangkat_desa',
            'lihat_notifikasi',
        ]);

        // Warga — limited to viewing and submitting
        $warga = Role::firstOrCreate(['name' => 'Warga']);
        $warga->syncPermissions([
            'lihat_surat', 'ajukan_surat',
            'lihat_pengaduan', 'ajukan_pengaduan',
            'lihat_berita', 'lihat_pengumuman', 'lihat_agenda', 'lihat_galeri',
            'lihat_potensi', 'lihat_profil_desa', 'lihat_perangkat_desa',
            'lihat_notifikasi',
        ]);
    }
}
