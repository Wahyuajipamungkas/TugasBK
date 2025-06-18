<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use SoftDeletes;
    protected $table = 'obats';
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];
    public function detailPeriksa()
    {
        return $this->hasMany(detail_periksa::class, 'id_obat');
    }
}
