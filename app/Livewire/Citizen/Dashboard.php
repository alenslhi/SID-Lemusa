<?php

namespace App\Livewire\Citizen;

use Livewire\Component;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Surat\Models\JenisSurat;
use App\Domain\Surat\Models\StatusSurat;
use App\Domain\Surat\Models\PengajuanSurat;
use App\Domain\Pengaduan\Models\Pengaduan;
use App\Domain\Pengaduan\Models\KategoriPengaduan;
use Illuminate\Support\Str;


class Dashboard extends Component
{
    public string $activeTab = 'overview';
    
    // Modal states
    public bool $showSuratModal = false;
    public bool $showPengaduanModal = false;

    // Form inputs for Surat
    public ?int $jenis_surat_id = null;

    // Form inputs for Pengaduan
    public string $judul = '';
    public ?int $kategori_pengaduan_id = null;
    public string $isi_laporan = '';

    public function mount(): void
    {
        $user = auth()->user();
        if (!$user || (!$user->hasRole('Warga') && !$user->hasRole('Super Admin'))) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk warga.');
        }
    }

    protected function rules(): array
    {
        if ($this->showSuratModal) {
            return [
                'jenis_surat_id' => 'required|exists:jenis_surat,id',
            ];
        }

        return [
            'judul' => 'required|string|min:5|max:100',
            'kategori_pengaduan_id' => 'required|exists:kategori_pengaduan,id',
            'isi_laporan' => 'required|string|min:15|max:1000',
        ];
    }

    protected $validationAttributes = [
        'jenis_surat_id' => 'Jenis Surat',
        'judul' => 'Judul Pengaduan',
        'kategori_pengaduan_id' => 'Kategori Pengaduan',
        'isi_laporan' => 'Isi Laporan/Aduan',
    ];

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetValidation();
    }

    public function openSuratModal(): void
    {
        $this->jenis_surat_id = null;
        $this->showSuratModal = true;
        $this->resetValidation();
    }

    public function openPengaduanModal(): void
    {
        $this->judul = '';
        $this->kategori_pengaduan_id = null;
        $this->isi_laporan = '';
        $this->showPengaduanModal = true;
        $this->resetValidation();
    }

    public function submitSurat(): void
    {
        $this->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
        ]);

        $user = auth()->user();
        $penduduk = $user->penduduk;

        if (!$penduduk) {
            session()->flash('error', 'Data penduduk Anda tidak ditemukan. Silakan hubungi operator desa.');
            $this->showSuratModal = false;
            return;
        }

        $jenis = JenisSurat::find($this->jenis_surat_id);
        $slug = Str::slug($jenis->nama);
        $kode = 'SRT-' . strtoupper(substr($slug, 0, 8)) . '-' . strtoupper(Str::random(6));

        // Status Surat: 1 = Menunggu Verifikasi
        PengajuanSurat::create([
            'kode_pengajuan' => $kode,
            'penduduk_id' => $penduduk->id,
            'jenis_surat_id' => $this->jenis_surat_id,
            'status_surat_id' => 1,
            'estimasi_selesai' => now()->addDays(3),
        ]);

        $this->showSuratModal = false;
        $this->jenis_surat_id = null;

        session()->flash('success_surat', 'Pengajuan surat ' . $jenis->nama . ' berhasil dikirim! Silakan lacak statusnya.');
    }

    public function submitPengaduan(): void
    {
        $this->validate([
            'judul' => 'required|string|min:5|max:100',
            'kategori_pengaduan_id' => 'required|exists:kategori_pengaduan,id',
            'isi_laporan' => 'required|string|min:15|max:1000',
        ]);

        $user = auth()->user();
        $penduduk = $user->penduduk;

        if (!$penduduk) {
            session()->flash('error', 'Data penduduk Anda tidak ditemukan. Silakan hubungi operator desa.');
            $this->showPengaduanModal = false;
            return;
        }

        Pengaduan::create([
            'judul' => $this->judul,
            'penduduk_id' => $penduduk->id,
            'kategori_pengaduan_id' => $this->kategori_pengaduan_id,
            'isi_laporan' => $this->isi_laporan,
            'status' => 'baru',
        ]);

        $this->showPengaduanModal = false;
        $this->judul = '';
        $this->kategori_pengaduan_id = null;
        $this->isi_laporan = '';

        session()->flash('success_pengaduan', 'Aduan/Laporan Anda berhasil dikirim! Laporan akan segera diproses oleh perangkat desa.');
    }

    public function logout(): void
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect('/admin/login');
    }

    public function render()
    {
        $user = auth()->user();
        $penduduk = $user->penduduk;

        // Fetch user data
        $suratList = $penduduk ? PengajuanSurat::with(['jenisSurat', 'statusSurat'])->where('penduduk_id', $penduduk->id)->orderBy('created_at', 'desc')->get() : collect();
        $pengaduanList = $penduduk ? Pengaduan::with(['kategoriPengaduan'])->where('penduduk_id', $penduduk->id)->orderBy('created_at', 'desc')->get() : collect();

        // Calculate statistics
        $stats = [
            'total_surat' => $suratList->count(),
            'surat_selesai' => $suratList->filter(fn($s) => $s->statusSurat?->nama === 'Selesai')->count(),
            'surat_proses' => $suratList->filter(fn($s) => in_array($s->statusSurat?->nama, ['Sedang Diproses', 'Menunggu Tanda Tangan']))->count(),
            'total_pengaduan' => $pengaduanList->count(),
            'pengaduan_selesai' => $pengaduanList->filter(fn($p) => $p->status === 'selesai')->count(),
            'pengaduan_proses' => $pengaduanList->filter(fn($p) => in_array($p->status, ['baru', 'proses', 'diproses']))->count(),
        ];

        // Master lists for dropdowns
        $jenisSurat = JenisSurat::all();
        $kategoriPengaduan = KategoriPengaduan::all();

        return view('livewire.citizen.dashboard', [
            'user' => $user,
            'penduduk' => $penduduk,
            'suratList' => $suratList,
            'pengaduanList' => $pengaduanList,
            'stats' => $stats,
            'jenisSurat' => $jenisSurat,
            'kategoriPengaduan' => $kategoriPengaduan,
        ])->layout('layouts.citizen');
    }
}
