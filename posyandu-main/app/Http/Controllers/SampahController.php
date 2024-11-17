<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Posko;
use App\Models\Posyandu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function posko(): View
    {
        $no = 1;
        $data = Posko::onlyTrashed()->get();

        return view('sampah.posko', compact('no', 'data'));
    }
    public function poskoDelete($id)
    {
        $no = 1;
        $data = Posko::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect(route('sampah.posko'))->with('danger', 'data posko posyandu berhasil di delete permanen',);
    }
    public function poskoRestore($id)
    {
        $no = 1;
        $data = Posko::onlyTrashed()->where('id', $id)->restore();

        return redirect(route('sampah.posko'))->with('success', 'data posko posyandu berhasil di pulihkan');
    }

    public function jadwal(): View
    {
        $no = 1;
        $data = Jadwal::onlyTrashed()->get();

        return view('sampah.jadwal', compact('no', 'data'));
    }

    public function jadwalDelete($id)
    {
        $no = 1;
        $data = Jadwal::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect(route('sampah.jadwal'))->with('danger', 'data jadwal posyandu berhasil di delete permanen',);
    }
    public function jadwalRestore($id)
    {
        $no = 1;
        $data = Jadwal::onlyTrashed()->where('id', $id)->restore();

        return redirect(route('sampah.jadwal'))->with('success', 'data jadwal posyandu berhasil di pulihkan');
    }
    public function posyandu(): View
    {
        $no = 1;
        $data = Posyandu::onlyTrashed()->get();

        return view('sampah.posyandu', compact('no', 'data'));
    }
    public function posyanduDetail($id): View
    {
        $no = 1;
        $data = Posyandu::onlyTrashed()->find($id);

        return view('sampah.posyanduDetail', compact('no', 'data'));
    }

    public function posyanduDelete($id)
    {
        $no = 1;
        $data = Posyandu::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect(route('sampah.posyandu'))->with('danger', 'data  posyandu berhasil di delete permanen',);
    }
    public function posyanduRestore($id)
    {
        $no = 1;
        $data = Posyandu::onlyTrashed()->where('id', $id)->restore();

        return redirect(route('sampah.posyandu'))->with('success', 'data  posyandu berhasil di pulihkan');
    }
}
