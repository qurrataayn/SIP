<?php

namespace App\Repositories;

use App\Models\Kategori;


class KategoriRepository extends BaseRepository
{

    public function __construct(Kategori $model)
    {
        parent::__construct($model);
    }
}
