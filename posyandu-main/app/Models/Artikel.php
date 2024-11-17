<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';
    protected $fillable = [
        'judul',
        'slug',
        'images',
        'deskripsi',
        'kategori_id',
        'created_by',
    ];


    public function getUser()
    {
        return $this->hasOne(User::class, "id", "created_by");
    }

    public function getKategori()
    {
        return $this->hasOne(Kategori::class, "id", "kategori_id");
    }
}
