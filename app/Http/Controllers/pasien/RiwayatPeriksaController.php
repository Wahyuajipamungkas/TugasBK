<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;

use App\Models\Janji_Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeriksaController extends Controller
{
		// Function() lain ....
		// Taro dalam kelas RiwayatPeriksaController
    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $janjiPeriksas = Janji_Periksa::where('id_pasien', Auth::user()->id)->get();
        // dd($janjiPeriksas);
        return view('pasien.riwayat_periksa.index')->with([
            'no_rm' => $no_rm,
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    public function detail($id)
    {
        $janjiPeriksa = Janji_Periksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);

        return view('pasien.riwayat_periksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    public function riwayat($id)
    {
        $janjiPeriksa = Janji_Periksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);
        $riwayat = $janjiPeriksa->riwayatPeriksa;

        return view('pasien.riwayat_periksa.riwayat')->with([
            'riwayat' => $riwayat,
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }
}

