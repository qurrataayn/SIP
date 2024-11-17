<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jadwal_posyandu';

    protected $casts = [
        'tanggal' => 'date',
    ];
    protected $fillable = [
        'judul',
        'posko_id',
        'kategori',
        'tanggal',
        'start',
        'finish',
    ];

    public function getposko()
    {
        return $this->hasOne(Posko::class, "id", "posko_id");
    }
}
