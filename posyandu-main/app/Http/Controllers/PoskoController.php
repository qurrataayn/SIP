<?php

namespace App\Http\Controllers;

use App\Repositories\PoskoRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoskoController extends Controller
{
    public function __construct(
        PoskoRepository $poskoRepository
    ) {
        $this->poskoRepository = $poskoRepository;
    }

    public function index(): View
    {
        $no = 1;
        $data = $this->poskoRepository->getData();

        return view('posko.index', compact('no', 'data'));
    }
    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('posko'))->with('danger', $validator->errors()->first('*'));
        }


        $data = $this->poskoRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('posko'))->with('success', 'data posko posyandu berhasil di tambahkan');
        } else {
            return redirect(route('posko'))->with('warning', 'data posko posyandu berhasil di edit');
        }
        return redirect();
    }

    public function delete($id)
    {
        if ($id == 0) {
            return redirect(route('posko'))->with('danger', 'data posko posyandu tidak ditemukan');
        }
        $data = $this->poskoRepository->delete($id);
        return redirect(route('posko'))->with('danger', 'data posko posyandu berhasil di hapus');
    }

    private function rules($id)
    {
        return [
            'name' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'rw' => ['required'],
            'rt' => ['required'],
        ];
    }
}
