<?php

namespace App\Http\Controllers;

use App\Repositories\JadwalRepository;
use App\Repositories\PoskoRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function __construct(
        JadwalRepository $jadwalRepository,
        PoskoRepository $poskoRepository
    ) {
        $this->jadwalRepository = $jadwalRepository;
        $this->poskoRepository = $poskoRepository;
    }

    public function index(): View
    {
        $where = array(
            'posko_id' => Auth::user()->posko_id
        );
        $no = 1;
        if (Auth::user()->role_id == 2 || Auth::user()->role_id == 4) {
            $data = $this->jadwalRepository->whereData($where)->get();
            $posko = $this->poskoRepository->getData();
        } else {
            $data = $this->jadwalRepository->getData();
            $posko = $this->poskoRepository->getData();
        }
        return view('jadwal.index', compact('no', 'data', 'posko'));
    }
    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('jadwal'))->with('danger', $validator->errors()->first('*'));
        }

        $data = $this->jadwalRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('jadwal'))->with('success', 'data jadwal berhasil di tambahkan');
        } else {
            return redirect(route('jadwal'))->with('warning', 'data jadwal berhasil di edit');
        }
        return redirect();
    }

    public function delete($id)
    {
        if ($id == 0) {
            return redirect(route('jadwal'))->with('danger', 'data jadwal posyandu tidak ditemukan');
        }
        $data = $this->jadwalRepository->delete($id);
        return redirect(route('jadwal'))->with('danger', 'data jadwal posyandu berhasil di hapus');
    }

    private function rules($id)
    {
        return [
            'judul' => ['required'],
            'posko_id' => ['required'],
            'tanggal' => ['required'],
            'start' => ['required'],
            'finish' => ['required'],
        ];
    }
}
