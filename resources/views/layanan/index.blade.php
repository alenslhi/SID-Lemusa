@extends('layouts.public')

@section('title', 'Layanan Publik')

@section('content')
<!-- Hero Section for Layanan Index -->
<div class="bg-emerald-700 py-16 sm:py-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl tracking-tight">Layanan Publik Terpadu</h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
            Akses seluruh layanan administrasi kependudukan dan surat-menyurat dengan cepat dan transparan.
        </p>
    </div>
</div>

<div class="bg-slate-50 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Layanan Pengajuan Surat -->
        <section id="surat" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-10 scroll-mt-28">
            <div class="lg:flex lg:items-center lg:gap-12">
                <div class="lg:w-1/3 mb-8 lg:mb-0 hidden lg:block">
                    <div class="bg-emerald-50 aspect-square rounded-2xl flex items-center justify-center border border-emerald-100">
                         <svg class="w-32 h-32 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="lg:w-2/3">
                    <div class="flex items-center gap-3 mb-4 text-emerald-600">
                        <svg class="w-8 h-8 lg:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pengajuan Surat Administrasi</h2>
                    </div>
                    <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                        Kini, warga Desa Lemusa dapat mengajukan permohonan surat administrasi (seperti Surat Keterangan Domisili, Pengantar SKCK, Surat Keterangan Usaha, dll) tanpa harus antre lama di balai desa.
                    </p>
                    <div class="bg-slate-50 rounded-xl p-6 mb-8 border border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-3">Langkah Pengajuan:</h4>
                        <ol class="list-decimal pl-5 space-y-2 text-slate-600">
                            <li>Klik tombol <strong>Buat Pengajuan</strong> di bawah ini (Anda akan diarahkan ke Portal Warga).</li>
                            <li>Pilih layanan surat yang Anda butuhkan.</li>
                            <li>Lengkapi formulir yang diminta beserta foto/scan persyaratan (KK/KTP).</li>
                            <li>Tunggu notifikasi atau cek profil Anda untuk mengunduh surat yang telah disetujui (diberi Tanda Tangan Elektronik).</li>
                        </ol>
                    </div>
                    <a href="/admin/login" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Buat Pengajuan Surat
                        <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Layanan Pengaduan -->
        <section id="pengaduan" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-10 scroll-mt-28">
            <div class="lg:flex lg:items-center lg:flex-row-reverse lg:gap-12">
                <div class="lg:w-1/3 mb-8 lg:mb-0 hidden lg:block">
                    <div class="bg-teal-50 aspect-square rounded-2xl flex items-center justify-center border border-teal-100">
                         <svg class="w-32 h-32 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                </div>
                <div class="lg:w-2/3">
                     <div class="flex items-center gap-3 mb-4 text-emerald-600">
                        <svg class="w-8 h-8 lg:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pelaporan / Pengaduan Warga</h2>
                    </div>
                    <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                        Kami mengedepankan transparansi. Jika Anda menemukan masalah terkait fasilitas umum, gangguan layanan, atau memiliki aspirasi maupun kritik yang membangun untuk desa, jangan ragu untuk melapor.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="card bg-slate-50 p-4 rounded-xl border border-slate-100 flex items-start gap-4">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Privasi Dijamin</h4>
                                <p class="text-xs text-slate-500 mt-1">Identitas pelapor bersifat rahasia dan aman di sisi admin desa.</p>
                            </div>
                        </div>
                        <div class="card bg-slate-50 p-4 rounded-xl border border-slate-100 flex items-start gap-4">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Respon Cepat</h4>
                                <p class="text-xs text-slate-500 mt-1">Pengaduan akan di follow-up oleh dinas terkait max 2x24 Jam.</p>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/login" class="inline-flex items-center px-6 py-3 border border-slate-300 text-base font-medium rounded-md shadow-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Kirim Laporan
                        <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection