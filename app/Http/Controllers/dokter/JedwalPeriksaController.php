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
            'status' => true, // atau false jika ingin nonaktif default
        ]);

        return redirect()->route('dokter.jadwal_periksa.index')->with('status', 'jadwal-created');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'hari' => 'required|string|max:200',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:0,1',
        ]);

        $jadwal = Jadwal_Periksa::findOrFail($id);

        $jadwal->update([
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('dokter.jadwal.index')->with('status', 'jadwal-updated');
    }

    public function toggleStatus($id)
    {
    $jadwal = Jadwal_Periksa::findOrFail($id);
    $jadwal->status = !$jadwal->status;
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
