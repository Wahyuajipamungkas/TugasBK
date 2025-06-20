<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'deskripsi',
    ];

    // Di dalam model Poli
    public function dokter()
    {
        return $this->hasMany(User::class, 'id_poli', 'id')->where('role', 'dokter');
    }

}
