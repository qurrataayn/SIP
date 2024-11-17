<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'keluarga';
    protected $fillable = [

        'nama_keluarga',
        'alamat',
        'no_telpon',
        'rt',
        'rw',

    ];

    protected $appends = [
        'jumlah_anggota'
    ];

    public function getAnggota()
    {
        return $this->hasMany(Anggota::class, "keluarga_id", "id");
    }

    public function getUser()
    {
        return $this->hasOne(User::class, "keluarga_id", "id");
    }

    public function getJumlahAnggotaAttribute()
    {
        $anggota = $this->getAnggota->count();
        return $anggota ? $anggota : 0;
    }
}
