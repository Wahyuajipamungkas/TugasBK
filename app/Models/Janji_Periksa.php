<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Janji_Periksa extends Model
{
    protected $table = 'janji_periksas';
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'status',
        'tanggal_periksa',
        'keluhan',
        'no_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(jadwal_periksa::class, 'id_jadwal');
    }
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }

}
