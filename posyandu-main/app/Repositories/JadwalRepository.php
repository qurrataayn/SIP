<?php

namespace App\Repositories;

use App\Models\Jadwal;


class JadwalRepository extends BaseRepository
{

    public function __construct(Jadwal $model)
    {
        parent::__construct($model);
    }


    public function cetak($where = array(), $start, $end)
    {

        $dataQuery = $this->model
            ->where($where);

        if ($start !== null || $end !== null) {
            if ($start !== null && $end !== null) {
                $dataQuery->whereBetween('tanggal', [$start, $end]);
            } elseif ($start !== null) {
                $dataQuery->where('tanggal', '>=', $start);
            } elseif ($end !== null) {
                $dataQuery->where('tanggal', '<=', $end);
            }
        }

        $data = $dataQuery->get();
        return $data;
    }
}
