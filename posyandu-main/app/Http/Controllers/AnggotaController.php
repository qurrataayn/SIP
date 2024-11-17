<?php

namespace App\Http\Controllers;

use App\Repositories\AnggotaRepository;
use App\Repositories\KeluargaRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function __construct(
        AnggotaRepository $anggotaRepository,
        KeluargaRepository $keluargaRepository
    ) {
        $this->anggotaRepository = $anggotaRepository;
        $this->keluargaRepository = $keluargaRepository;
    }

    public function index($id): View
    {
        $where = array(
            'keluarga_id' => $id,
        );
        $no = 1;
        $data = $this->anggotaRepository->whereData($where)->get();
        $keluarga = $this->keluargaRepository->find($id);

        return view('anggota.index', compact('no', 'data', 'keluarga'));
    }
    public function storeAndUpdate(Request $request, $keluarga)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('anggota', $keluarga))->with('danger', $validator->errors()->first('*'));
        }

        $request->request->add(['keluarga_id' => $keluarga]);

        $data = $this->anggotaRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('anggota', $keluarga))->with('success', 'data anggota Keluarga berhasil di tambahkan');
        } else {
            return redirect(route('anggota', $keluarga))->with('warning', 'data anggota keluarga berhasil di edit');
        }
        return redirect();
    }

    public function delete($id)
    {
        if ($id == 0) {
            return Redirect::back()->with('danger', 'data posko posyandu tidak ditemukan');
        }
        $data = $this->anggotaRepository->delete($id);
        return Redirect::back()->with('danger', 'data posko posyandu berhasil di hapus');
    }

    private function rules($id)
    {
        return [
            'nik' => ['required', 'numeric'],
            'keluarga_id' => "exists:keluarga,id",
            'nama_anggota' => ['required'],
            'jenis_kelamin' => ['required', 'numeric'],
        ];
    }
}
