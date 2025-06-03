<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Janji_Periksa;
use App\Models\User;
use App\Models\Jadwal_Periksa;

class JanjiPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pasien = User::where('role', 'pasien')->first();
        $jadwal = Jadwal_Periksa::first();

        Janji_Periksa::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $jadwal->id,
            'keluhan' => 'Sakit kepala dan demam',
            'no_antrian' => 1,
        ]);
    }
}
