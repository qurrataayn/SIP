<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Repositories\ArtikelRepository;
use App\Repositories\KategoriRepository;
use App\Traits\ImageUpload;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    use ResponseAPI;
    use ImageUpload;

    public function __construct(
        ArtikelRepository $articleRepository,
        KategoriRepository $kategoryRepository

    ) {
        $this->articleRepository = $articleRepository;
        $this->kategoryRepository = $kategoryRepository;
    }
    function index()
    {
        $no = 1;
        $data = $this->articleRepository->getData();
        $kategori = $this->kategoryRepository->getData();
        return view('artikel.index', compact('data', 'no', 'kategori'));
    }

    function storeAndUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return $this->success("bad request, error validation", $validator->errors(), 400, count($validator->errors()));
        }
        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $folder = "image/artikel/";

        if ($id == 0) {
            $images = $this->SaveImage($request, $folder);
        } else {
            $old = Artikel::where('id', $id)->first();
            $images = $this->UpdateImage($request, $folder, $old->image);
        }

        $slug = Str::slug($request->judul);
        $request->request->add(['slug' => $slug]);
        $request->request->add(['images' => $images]);
        $request->request->add(['created_by' => Auth::user()->id]);

        $data = $this->articleRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('artikel'))->with('success', 'artikel data added successfully');
        } else {
            return redirect(route('artikel'))->with('warning', 'artikel data updated successfully');
        }
    }

    function delete($id)
    {
        $oldData = $this->articleRepository->find($id);
        $cek = isset($oldData) && (int)$oldData->id > 0 ? 1 : 0;

        if ($cek > 0) {
            $data = $this->articleRepository->delete($id, Auth::user()->id);
            return redirect(route('artikel'))->with('danger', 'artikel data delete successfully');
        } else {
            return redirect(route('artikel'))->with('danger', 'data not found !');
        }
    }

    private function rules()
    {
        return [];
    }
}
