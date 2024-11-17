<?php

namespace App\Repositories;

use App\Models\Keluarga;


class KeluargaRepository extends BaseRepository
{

    public function __construct(Keluarga $model)
    {
        parent::__construct($model);
    }

    public function posko($where = array())
    {
        $data = $this->model->whereHas('getUser', function ($query) use ($where) {
            $query->where($where);
        })->get();

        return $data;
    }

    public function count_anggota($where = array())
    {
        $data = $this->model->whereHas('getUser', function ($query) use ($where) {
            $query->where($where);
        })->get()->count();

        return $data;
    }
}
