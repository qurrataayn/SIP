<?php

namespace App\Repositories;


use App\Models\Posyandu;

class PosyanduRepository extends BaseRepository
{

    public function __construct(Posyandu $model)
    {
        parent::__construct($model);
    }

    public function cetak($where = array(), $start, $end, $min_usia, $max_usia)
    {

        $dataQuery = $this->model
            ->where($where);

        if ($start !== null || $end !== null) {
            if ($start !== null && $end !== null) {
                $dataQuery->whereBetween('created_at', [$start, $end]);
            } elseif ($start !== null) {
                $dataQuery->where('created_at', '>=', $start);
            } elseif ($end !== null) {
                $dataQuery->where('created_at', '<=', $end);
            }
        }

        if ($min_usia !== 0 || $max_usia !== 0) {
            if ($min_usia !== 0 && $max_usia !== 0) {
                $dataQuery->whereBetween('umur', [$min_usia, $max_usia]);
            } elseif ($min_usia !== 0) {

                $dataQuery->where('umur', '>=', $min_usia);
            } elseif ($max_usia !== 0) {
                $dataQuery->where('umur', '<=', $max_usia);
            }
        }

        $data = $dataQuery->get();
        return $data;
    }

    public function whereKeluarga($keluarga_id)
    {
        $data = $this->model->wherehas('getAnggota', function ($query) use ($keluarga_id) {

            $query->where('keluarga_id', $keluarga_id);
        });

        return $data;
    }
}
