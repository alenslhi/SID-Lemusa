<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Keluarga\Models\Keluarga;
use App\Domain\Dusun\Models\Dusun;
use App\Domain\Berita\Models\Berita;
use App\Domain\ProfilDesa\Models\ProfilDesa;

class HomeController extends Controller
{
    public function index()
    {
        $statistik = [
            'penduduk' => Penduduk::count(),
            'keluarga' => Keluarga::count(),
            'dusun' => Dusun::count(),
            'surat' => \App\Domain\Surat\Models\JenisSurat::count(),
        ];

        // Fetch latest published news if any
        $beritaTerbaru = Berita::latest()->take(3)->get();

        return view('home', compact('statistik', 'beritaTerbaru'));
    }

    public function profil()
    {
        // Get the first profil desa record (assuming it's a settings-like table with 1 row)
        $profil = ProfilDesa::first();
        
        return view('profil.index', compact('profil'));
    }

    public function layanan()
    {
        return view('layanan.index');
    }

    public function beritaIndex()
    {
        // Paginate news for the index page
        $semuaBerita = Berita::latest()->paginate(9);

        return view('berita.index', compact('semuaBerita'));
    }

    public function beritaShow($slug)
    {
        // Find news by slug or fail
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // Optional: fetch related/latest news to show in the sidebar layout
        $beritaTerkait = Berita::where('id', '!=', $berita->id)->latest()->take(4)->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}
