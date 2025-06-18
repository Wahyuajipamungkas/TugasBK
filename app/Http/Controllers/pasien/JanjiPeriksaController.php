<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\Jadwal_Periksa;
use App\Models\Janji_Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class JanjiPeriksaController extends Controller
{
    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $dokters = User::with([
            'jadwalPeriksa' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();

        return view('pasien.janji_periksa.index')->with([
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'keluhan' => 'required',
        ]);

        $jadwalPeriksa = Jadwal_Periksa::where('id_dokter', $request->id_dokter)
            ->where('status', true)
            ->first();

        $jumlahJanji = Janji_Periksa::where('id_jadwal', $jadwalPeriksa->id)->count();
        $noAntrian = $jumlahJanji + 1;

        Janji_Periksa::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal' => $jadwalPeriksa->id,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return Redirect::route('pasien.janji_periksa.index')->with('status', 'janji_periksa_created');
    }
}
