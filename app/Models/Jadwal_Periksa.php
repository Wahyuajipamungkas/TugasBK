<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Periksa extends Model
{
protected $table = 'jadwal_periksas';
protected $fillable = [
    'id_dokter',
    'hari',
    'jam_mulai',
    'jam_selesai',
    'status',

];

public function dokter()
{
    return $this->belongsTo(User::class, 'id_dokter');
}
public function Janji_Periksa()
{
    return $this->hasMany(Janji_Periksa::class, 'id_jadwal');
}
}
