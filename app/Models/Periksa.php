<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksas';
    protected $fillable = [
        'id_janji_periksa',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    public function janjiPeriksa()
    {
        return $this->belongsTo(Janji_Periksa::class, 'id_janji_periksa');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
    public function detailPeriksa()
    {
        return $this->hasMany(Detail_periksa::class, 'id_periksa');
    }


}
