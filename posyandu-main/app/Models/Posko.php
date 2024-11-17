<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posko extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posko_posyandu';
    protected $fillable = [
        'name',
        'kota',
        'kecamatan',
        'kelurahan',
        'rw',
        'rt',
    ];
}
