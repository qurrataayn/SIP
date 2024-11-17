<?php

namespace App\Http\Controllers;

use App\Repositories\KategoriRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function __construct(
        KategoriRepository $kategoriRepository
    ) {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function index()
    {
        $no = 1;
        $data = $this->kategoriRepository->getData();

        return view('kategori.index', compact('no', 'data'));
    }
    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));
        $slug = Str::slug($request->nama);
        $request->request->add(['slug' => $slug]);
        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('kategori'))->with('danger', $validator->errors()->first('*'));
        }


        $data = $this->kategoriRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('kategori'))->with('success', 'data kategori Artikel berhasil di tambahkan');
        } else {
            return redirect(route('kategori'))->with('warning', 'data kategori Artikel berhasil di edit');
        }
        return redirect();
    }

    public function delete($id)
    {
        if ($id == 0) {
            return redirect(route('kategori'))->with('danger', 'data kategori Artikel tidak ditemukan');
        }
        $data = $this->kategoriRepository->delete($id);
        return redirect(route('kategori'))->with('danger', 'data kategori Artikel berhasil di hapus');
    }

    private function rules($id)
    {
        return [
            'nama' => ['required'],
        ];
    }
}
