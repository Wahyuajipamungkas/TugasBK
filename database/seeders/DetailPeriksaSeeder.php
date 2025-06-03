<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Detail_periksa;
use App\Models\Periksa;
use App\Models\Obat;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        $periksa = Periksa::first();
        $obat = Obat::first();

        Detail_periksa::create([
            'id_periksa' => $periksa->id,
            'id_obat' => $obat->id
        ]);
    }
}
