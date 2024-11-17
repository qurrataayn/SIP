<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    function index()
    {
        $kategori = Kategori::get();
        $artikel = Artikel::orderBy("id", "desc")->get();
        $jumlah = Artikel::orderBy("id", "desc")->get()->count();

        return view('welcome', compact('kategori', 'artikel', 'jumlah'));
    }

    function pencarian(Request $request)
    {
        $kategori = Kategori::get();
        $artikel = Artikel::where("kategori_id", $request->kategori)->whereRaw("LOWER(judul) like '%" . $request->judul . "%'")->orderBy("id", "desc")->get();
        $jumlah = Artikel::where("kategori_id", $request->kategori)->whereRaw("LOWER(judul) like '%" . $request->judul . "%'")->orderBy("id", "desc")->get()->count();
        return view('welcome', compact('kategori', 'artikel', 'jumlah'));
    }

    function detailArtikel($slug)
    {
        $kategori = Kategori::get();
        $artikel = Artikel::where('slug', $slug)->first();
        $artikelKategori = Artikel::where("kategori_id", $artikel->kategori_id)->orderBy("id", "desc")->get();

        return view('artikelDetail', compact('artikel', 'kategori', 'artikelKategori'));
    }
}
