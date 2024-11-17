<?php

namespace App\Repositories;

use App\Traits\ResponseAPI;
use DB;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public $model;

    use ResponseAPI;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getData()
    {

        return $this->model->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function countData($where = array())
    {
        $data = $this->model->where($where)->count();
        return $data;
    }
    public function whereData($where = array())
    {
        $data = $this->model->where($where);
        return $data;
    }

    public function getAllData($where = array(), $per_page = 10, $offset = 1, $sort_column, $sort_order = "ASC")
    {
        $data = $this->model->where($where)->offset($offset)->limit($per_page)->orderBy($sort_column, $sort_order)->get();
        return $data;
    }

    public function countSearchData($where = array(), $search_column = "", $keyword = "")
    {
        $data = $this->model->where($where)->whereRaw("LOWER($search_column) like '%" . $keyword . "%'")->count();
        return $data;
    }

    public function searchData($where = array(), $per_page = 10, $offset = 1, $sort_column, $sort_order = "ASC", $search_column = "", $keyword = "")
    {
        $data = $this->model->where($where)->whereRaw("LOWER($search_column) like '%" . $keyword . "%'")->offset($offset)->limit($per_page)->orderBy($sort_column, $sort_order)->get();
        return $data;
    }

    public function CreateOrUpdate(array $attributes, $id = null)
    {
        DB::beginTransaction();
        try {
            if ($id > 0) {
                $data = $this->model->find($id);
                if ($id && !$data) return $this->error("No data with ID $id", 404);

                $data->fill($attributes);
                $data->save();
            } else {

                $data = $this->model->create($attributes);
            }
            DB::commit();
            return $this->success("ok", $data, 200, 1);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        $data = $this->model->findOrFail($id);

        $data->delete();
        return $data;
    }

    public function insertBatch(array $attributes)
    {
        $this->model->insert($attributes);
    }

    public function updateWhere($where, $data)
    {
        DB::beginTransaction();
        try {
            $dataa = $this->model->where($where)->first();

            $data = $dataa->update($data);
            DB::commit();
            return $dataa;
        } catch (Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
