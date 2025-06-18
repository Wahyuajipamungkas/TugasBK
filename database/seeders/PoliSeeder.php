<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('polis')->insert([
            [
                'nama_poli' => 'Poli Gigi',
                'deskripsi' => 'Menangani perawatan dan pemeriksaan gigi.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_poli' => 'Poli Anak',
                'deskripsi' => 'Pelayanan kesehatan untuk anak-anak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_poli' => 'Poli Penyakit Dalam',
                'deskripsi' => 'Menangani penyakit dalam seperti diabetes, hipertensi, dll.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
