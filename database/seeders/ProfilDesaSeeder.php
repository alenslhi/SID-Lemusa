<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    public function run(): void
    {
        ProfilDesa::firstOrCreate(
            ['id' => 1],
            [
                'nama_desa' => 'Desa Lemusa',
                'sejarah' => 'Desa Lemusa merupakan salah satu desa yang berada di wilayah kecamatan dengan sejarah panjang yang kaya akan budaya dan tradisi lokal.',
                'visi' => 'Mewujudkan Desa Lemusa yang mandiri, sejahtera, dan berbudaya.',
                'misi' => "1. Meningkatkan kualitas pelayanan publik\n2. Mengembangkan potensi ekonomi masyarakat\n3. Melestarikan budaya dan kearifan lokal\n4. Meningkatkan infrastruktur desa\n5. Mewujudkan tata kelola pemerintahan desa yang baik",
                'alamat' => 'Jl. Desa Lemusa No. 1, Kecamatan Lemusa',
                'email' => 'desa.lemusa@gmail.com',
                'telepon' => '(0431) 123456',
                'sambutan_kepala_desa' => 'Selamat datang di website resmi Desa Lemusa. Melalui platform ini, kami berharap dapat memberikan pelayanan yang lebih baik dan transparan kepada seluruh masyarakat desa.',
            ]
        );
    }
}
