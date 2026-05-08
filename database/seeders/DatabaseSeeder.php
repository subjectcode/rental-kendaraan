<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kendaraan = [
            ['nama_kendaraan' => 'Avanza',     'jenis' => 'Mobil', 'merk' => 'Toyota',   'harga_sewa' => 350000, 'status' => 'tersedia'],
            ['nama_kendaraan' => 'Brio',       'jenis' => 'Mobil', 'merk' => 'Honda',    'harga_sewa' => 300000, 'status' => 'tersedia'],
            ['nama_kendaraan' => 'Xenia',      'jenis' => 'Mobil', 'merk' => 'Daihatsu', 'harga_sewa' => 320000, 'status' => 'tersedia'],
            ['nama_kendaraan' => 'Vario 160',  'jenis' => 'Motor', 'merk' => 'Honda',    'harga_sewa' => 75000,  'status' => 'tersedia'],
            ['nama_kendaraan' => 'Nmax',       'jenis' => 'Motor', 'merk' => 'Yamaha',   'harga_sewa' => 100000, 'status' => 'tersedia'],
            ['nama_kendaraan' => 'PCX 160',    'jenis' => 'Motor', 'merk' => 'Honda',    'harga_sewa' => 120000, 'status' => 'tersedia'],
        ];

        foreach ($kendaraan as $k) {
            Kendaraan::create($k);
        }

        $pelanggan = [
            ['nama' => 'Budi Santoso', 'nik' => '3201234567890001', 'no_hp' => '081234567890', 'alamat' => 'Jl. Merdeka No. 1, Jakarta'],
            ['nama' => 'Siti Aminah',  'nik' => '3201234567890002', 'no_hp' => '082345678901', 'alamat' => 'Jl. Sudirman No. 12, Bandung'],
        ];

        foreach ($pelanggan as $p) {
            Pelanggan::create($p);
        }
    }
}
