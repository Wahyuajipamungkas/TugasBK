<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jadwal_Periksa;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dokters = User::where('role', 'dokter')->get();

        foreach ($dokters as $dokter) {
            // Buat jadwal pertama (aktif)
            Jadwal_Periksa::create([
                'id_dokter' => $dokter->id,
                'hari' => 1, // Senin
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => 1, // aktif
            ]);

            // Buat jadwal kedua (nonaktif) hanya jika ID dokter genap
            if ($dokter->id % 2 == 0) {
                Jadwal_Periksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => 2, // Selasa
                    'jam_mulai' => '13:00:00',
                    'jam_selesai' => '16:00:00',
                    'status' => 0, // nonaktif
                ]);
            }
        }
    }
}
