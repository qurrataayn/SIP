<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Posko;
use App\Repositories\KeluargaRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class KeluargaController extends Controller
{
    public function __construct(
        KeluargaRepository $keluargaRepository
    ) {
        $this->keluargaRepository = $keluargaRepository;
    }

    public function index(): View
    {
        $no = 1;
        if (Auth::user()->role_id == 2) {
            $data = Keluarga::whereHas('getUser', function ($query) {
                $query->where('posko_id', Auth::user()->posko_id);
            })->orwhereDoesntHave('getUser')->get();
        } else {
            $data = $this->keluargaRepository->getData();
        }

        return view('keluarga.index', compact('no', 'data'));
    }
    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('keluarga'))->with('danger', $validator->errors()->first('*'));
        }


        $data = $this->keluargaRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('keluarga'))->with('success', 'data keluarga berhasil di tambahkan');
        } else {
            return redirect(route('keluarga'))->with('warning', 'data keluarga berhasil di edit');
        }
        return redirect();
    }

    private function rules($id)
    {
        return [
            'nama_keluarga' => ['required'],
            'alamat' => ['required'],
            'no_telpon' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
        ];
    }
}
