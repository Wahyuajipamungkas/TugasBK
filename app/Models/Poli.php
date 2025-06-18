<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'deskripsi',
    ];

    public function dokters(){
        return $this->hasMany(User::class, id_poli)->where('role','dokter');
    }
}
