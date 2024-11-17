<?php

namespace App\Repositories;

use App\Models\Anggota;



class AnggotaRepository extends BaseRepository
{

    public function __construct(Anggota $model)
    {
        parent::__construct($model);
    }
}
