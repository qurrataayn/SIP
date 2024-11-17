<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'anggota_keluarga';
    protected $fillable = [
        'nik',
        'keluarga_id',
        'nama_anggota',
        'jenis_kelamin',
    ];
    protected $appends = ['umur'];

    public function getKeluarga()
    {
        return $this->hasOne(Keluarga::class, "id", "keluarga_id");
    }

    public function getTanggalLahir()
    {
        return $this->hasOne(Posyandu::class, "anggota_id", "id")->latest('created_at');
    }

    public function getUmurAttribute()
    {
        $tanggalLahir = $this->getTanggalLahir()->first()->tanggal_lahir ?? null;

        // Jika tanggal lahir tidak ada, kembalikan 0
        if (is_null($tanggalLahir)) {
            return 0;
        }

        // Menghitung umur dalam bulan
        $birthDate = Carbon::parse($tanggalLahir);
        $currentDate = Carbon::now();

        // Menghitung selisih bulan
        return $birthDate->diffInMonths($currentDate);
    }
}
