<?php

namespace Database\Seeders;

use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Super Admin ───────────────────────────────────────
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@sid-lemusa.id'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // ─── Kepala Desa ───────────────────────────────────────
        $kepalaDesa = User::firstOrCreate(
            ['email' => 'kepaladesa@sid-lemusa.id'],
            [
                'name' => 'Kepala Desa Lemusa',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $kepalaDesa->assignRole('Kepala Desa');

        // ─── Operator Desa ─────────────────────────────────────
        $operator = User::firstOrCreate(
            ['email' => 'operator@sid-lemusa.id'],
            [
                'name' => 'Operator Desa',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $operator->assignRole('Operator Desa');

        // ─── Warga ─────────────────────────────────────────────
        $warga = User::firstOrCreate(
            ['email' => 'warga@sid-lemusa.id'],
            [
                'name' => 'Ahmad Warga',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );
        $warga->assignRole('Warga');
    }
}
