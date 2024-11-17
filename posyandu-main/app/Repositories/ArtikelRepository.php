<?php

namespace App\Repositories;

use App\Models\Artikel;


class ArtikelRepository extends BaseRepository
{

    public function __construct(Artikel $model)
    {
        parent::__construct($model);
    }
}
