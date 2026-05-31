<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileDownloadController extends Controller
{
    public function download(Request $request, string $path): StreamedResponse
    {
        // 1. Auth check
        if (!auth()->check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        // Normalize path and prevent directory traversal
        $path = str_replace('\\', '/', $path);
        if (str_contains($path, '..') || str_starts_with($path, '/') || str_contains($path, './')) {
            abort(400, 'Akses ditolak: Deteksi percobaan directory traversal.');
        }

        // 2. Perform access control based on paths
        if (str_starts_with($path, 'lampiran-pengaduan/')) {
            $lampiran = \App\Domain\Pengaduan\Models\LampiranPengaduan::where('file', $path)->first();
            if (!$lampiran) {
                abort(404, 'Berkas tidak ditemukan di database.');
            }
            $pengaduan = $lampiran->pengaduan;
            
            // Check ownership: Warga can only view their own
            if ($user->hasRole('Warga') && $pengaduan->penduduk_id !== $user->penduduk?->id) {
                abort(403, 'Anda tidak memiliki hak akses untuk berkas ini.');
            }
        } elseif (str_starts_with($path, 'lampiran-surat/')) {
            $lampiran = \App\Domain\Surat\Models\LampiranSurat::where('path_file', $path)->first();
            if (!$lampiran) {
                abort(404, 'Berkas tidak ditemukan di database.');
            }
            $pengajuan = $lampiran->pengajuanSurat;
            
            if ($user->hasRole('Warga') && $pengajuan->penduduk_id !== $user->penduduk?->id) {
                abort(403, 'Anda tidak memiliki hak akses untuk berkas ini.');
            }
        } elseif (str_starts_with($path, 'surat-hasil/')) {
            $hasil = \App\Domain\Surat\Models\SuratHasil::where('file_pdf', $path)->first();
            if (!$hasil) {
                abort(404, 'Berkas tidak ditemukan di database.');
            }
            $pengajuan = $hasil->pengajuanSurat;
            
            if ($user->hasRole('Warga') && $pengajuan->penduduk_id !== $user->penduduk?->id) {
                abort(403, 'Anda tidak memiliki hak akses untuk berkas ini.');
            }
        } else {
            // For other files (e.g. penduduk-foto), restrict to non-citizens
            if ($user->hasRole('Warga')) {
                abort(403, 'Anda tidak memiliki hak akses untuk berkas ini.');
            }
        }

        // Verify file exists on local private storage
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Berkas fisik tidak ditemukan.');
        }

        // Retrieve and return stream response
        return Storage::disk('local')->download($path);
    }
}
