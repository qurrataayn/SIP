<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posyandu extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posyandu';
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    protected $fillable = [
        'anggota_id',
        'posko_id',
        'tanggal_lahir',
        'tinggi_badan',
        'berat_badan',
        'umur',
        'lingkar_lengan',
        'lingkar_kepala',
        'imunisasi',
        'vitamin',
        'tekanan_darah',
        'obat_tambah_darah',
        'created_by',
    ];



    public function getPosko()
    {
        return $this->hasOne(Posko::class, "id", "posko_id");
    }

    public function getAnggota()
    {
        return $this->hasOne(Anggota::class, "id", "anggota_id");
    }

    public function getAge()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function calculateIdealWeightForToddler()
    {

        if ($this->umur < 1) {
            // Jika umur di bawah 1 tahun (dalam bulan)
            return (Carbon::parse($this->tanggal_lahir)->diffInMonths(Carbon::now()) / 2) + 4;
        } elseif ($this->umur >= 1 && $this->umur <= 5) {
            // Jika umur 1–5 tahun
            return ($this->umur * 2) + 8;
        } else {
            return null; // Tidak termasuk balita
        }
    }

    // Fungsi untuk mengecek apakah berat badan ideal balita
    public function isIdealWeightForToddler()
    {
        $idealWeight = $this->calculateIdealWeightForToddler();

        if ($idealWeight === null) {
            return false; // Tidak termasuk kategori balita
        }
        // dd($idealWeight);

        // Perbandingan ideal berat badan ±10%
        return $this->berat_badan >= $idealWeight * 0.9 && $this->berat_badan <= $idealWeight * 1.1;
    }

    public function calculateIdealHeightForToddler()
    {

        if ($this->umur < 1) {
            // Usia 0-12 bulan
            return  70 +  (Carbon::parse($this->tanggal_lahir)->diffInMonths(Carbon::now())  * 2.5);
        } elseif ($this->umur >= 1 && $this->umur <= 5) {
            // Usia 1-5 tahun
            return 75 + ($this->umur * 6.5);
        } else {
            return null; // Tidak termasuk balita
        }
    }

    // Fungsi untuk mengecek apakah tinggi badan ideal berdasarkan usia
    public function isIdealHeightForToddler()
    {
        $idealHeight = $this->calculateIdealHeightForToddler();
        if ($idealHeight === null) {
            return false; // Tidak termasuk kategori balita
        }
        // dd($idealHeight);
        // Tinggi badan ±10% dari tinggi ideal
        return $this->tinggi_badan >= $idealHeight * 0.9 && $this->tinggi_badan <= $idealHeight * 1.1;
    }
}
