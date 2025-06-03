<?php

namespace Database\Seeders;

use App\Models\Janji_Periksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        $janji = Janji_Periksa::first();

        Periksa::create([
            'id_janji_periksa' => $janji->id,
            'tgl_periksa' => now(),
            'catatan' => 'Diagnosa: flu ringan. Disarankan istirahat & minum obat.',
            'biaya_periksa' => 25000
        ]);
    }
}
