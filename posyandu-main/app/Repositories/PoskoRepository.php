<?php

namespace App\Repositories;


use App\Models\Posko;

class PoskoRepository extends BaseRepository
{

    public function __construct(Posko $model)
    {
        parent::__construct($model);
    }
}
