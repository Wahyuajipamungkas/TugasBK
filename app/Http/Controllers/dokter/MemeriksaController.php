<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_Periksa;
use App\Models\Janji_Periksa;
use App\Models\Detail_periksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class MemeriksaController extends Controller
{
    public function index(){
        $JadwalPeriksa = Jadwal_Periksa::where('id_dokter', Auth::user()->id)
            ->where('status', true)
            ->first();

        $janjiPeriksas = $JadwalPeriksa
            ? Janji_Periksa::where('id_jadwal', $JadwalPeriksa->id)->get()
            : collect(); // kosongkan jika tidak ada jadwal

        return view('dokter.memeriksa.index')->with([
            'janjiperiksas' => $janjiPeriksas,
        ]);
    }

    public function edit($id){
        $janjiPeriksa = Janji_Periksa::findOrFail($id);
        $obats = Obat::all();

        return view('dokter.memeriksa.edit')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats
        ]);
    }

    public function update($id, Request $request){
         $validateData = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string|max:200',
            'biaya_periksa' => 'required|numeric|min:0',
            'obats' => 'array',
            'obats.*' => 'exists:obats,id'
        ]);

        $janjiperiksa = Janji_Periksa::findOrFail($id);

        $periksa = Periksa::where('id_janji_periksa', $janjiperiksa->id)->first();
        $periksa->update([
            'tgl_periksa' => now()->format('Y-m-d'), // atau pakai $validateData['tgl_periksa']
            'catatan' => Arr::get($validateData, 'catatan'),
            'biaya_periksa' => $validateData['biaya_periksa'],
        ]);

        //buat Hapus Detail Periksa yang lama
        Detail_periksa::where('id_periksa', $periksa->id)->delete();

        //buat detail periksa yang baru
        foreach ($validateData['obats'] as $obatId) {
                Detail_periksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }

        return redirect()->route('dokter.memeriksa.index');
    }

    public function periksa($id){
        $janjiperiksa = Janji_Periksa::findOrFail($id);
        $obats = Obat::all();

        return view('dokter.memeriksa.periksa')->with([
            'janjiperiksa' => $janjiperiksa,
            'obats' => $obats,
        ]);
    }

     public function store($id, Request $request) {
        $validateData = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string|max:200',
            'biaya_periksa' => 'required|numeric|min:0',
            'obats' => 'array',
            'obats.*' => 'exists:obats,id'
        ]);

        $janjiperiksa = Janji_Periksa::findOrFail($id);

        $periksa = Periksa::create([
            'id_janji_periksa' => $janjiperiksa->id,
            'tgl_periksa' => now()->format('Y-m-d'), // atau pakai $validateData['tgl_periksa']
            'catatan' => Arr::get($validateData, 'catatan'),
            'biaya_periksa' => $validateData['biaya_periksa'],
        ]);

        if (!empty($validateData['obats'])) {
            foreach ($validateData['obats'] as $obatId) {
                Detail_periksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
    }
}
