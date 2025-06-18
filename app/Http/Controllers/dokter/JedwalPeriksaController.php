<?php

namespace App\Http\Controllers\dokter;

use Auth;
use Illuminate\Http\Request;
use App\Models\Jadwal_Periksa;
use App\Http\Controllers\Controller;

class JedwalPeriksaController extends Controller
{
    public function index()
    {
        $JadwalPeriksas = Jadwal_Periksa::where('id_dokter', Auth::user()->id)->get();

        return view('dokter.jadwal_periksa.index')->with([
            'JadwalPeriksas' => $JadwalPeriksas,
        ]);
    }

    public function create()
    {
        return view('dokter.jadwal_periksa.create');
    }

    public function edit($id)
    {
        $jadwal_periksas = Jadwal_Periksa::findOrFail($id);

        return view('dokter.jadwal_periksa.edit')->with([
            'jadwal_periksas' => $jadwal_periksas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:200',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        

        Jadwal_Periksa::create([
            'id_dokter' => auth()->user()->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false, // atau false jika ingin nonaktif default
        ]);

        return redirect()->route('dokter.jadwal_periksa.index')->with('status', 'jadwal-created');
    }
    public function toggleStatus($id)
    {
        $jadwal = Jadwal_Periksa::findOrFail($id);

        if (!$jadwal->status) {
            // Jika ingin mengaktifkan jadwal ini, nonaktifkan semua jadwal lain terlebih dahulu
            Jadwal_Periksa::where('id', '!=', $id)->update(['status' => false]);

            // Aktifkan jadwal ini
            $jadwal->status = true;
        } else {
            // Kalau status sekarang aktif, kita nonaktifkan
            $jadwal->status = false;
        }

        $jadwal->save();

        return redirect()->route('dokter.jadwal_periksa.index')->with('status', 'Status jadwal diperbarui.');
    }



    public function destroy($id)
    {
        $jadwal = Jadwal_Periksa::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dokter.jadwal_periksa.index')->with('status', 'jadwal-deleted');
    }
}
