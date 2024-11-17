<?php

namespace App\Http\Controllers;

use App\Repositories\JadwalRepository;
use App\Repositories\PoskoRepository;
use App\Repositories\PosyanduRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct(
        PosyanduRepository $posyanduRepository,
        JadwalRepository $jadwalRepository,
        PoskoRepository $poskoRepository
    ) {
        $this->jadwalRepository = $jadwalRepository;
        $this->poskoRepository = $poskoRepository;
        $this->posyanduRepository = $posyanduRepository;
    }

    public function kegiatan(): View
    {
        $no = 1;
        $where = array(
            'posko_id' => Auth::user()->posko_id
        );
        if (Auth::user()->role_id == 2) {
            $data = $this->jadwalRepository->whereData($where)->get()->sortByDesc('tanggal');
        } else {
            $data = $this->jadwalRepository->getData()->sortByDesc('tanggal');
        }
        $posko = $this->poskoRepository->getData();
        $today = now();

        return view('laporan.kegiatan', compact('no', 'data', 'posko', 'today'));
    }

    public function cetakKegiatan(Request $request)
    {
        $start = !empty($request->start) ? $request->start : null;
        $end = !empty($request->end) ? $request->end : null;

        $posko_id = (int)$request->posko_id > 0 ? (int)$request->posko_id : 0;
        $no = 1;
        $today = now();
        $where = array();

        if ($posko_id > 0) {
            $where += array('posko_id' => $posko_id);
        }

        if (Auth::user()->role_id == 2) {
            $where += array('posko_id' => Auth::user()->posko_id);
        }

        $data = $this->jadwalRepository->cetak($where, $start, $end);
        // dd($data);
        return view('laporan.cetakKegiatan', compact('no', 'data', 'today'));
    }

    public function posyandu(): View
    {
        $posko = $this->poskoRepository->getData();
        $today = now();
        $where = array(
            'posko_id' => Auth::user()->posko_id
        );
        $no = 1;

        if (Auth::user()->role_id == 2) {
            $data = $this->posyanduRepository->whereData($where)->get();
        } else {
            $data = $this->posyanduRepository->getData();
        }


        return view('laporan.posyandu', compact('no', 'data',  'posko', 'today'));
    }
    function posyanduDetail($id)
    {
        $data = $this->posyanduRepository->find($id);
        return view('laporan.posyanduDetail', compact('data'));
    }

    public function cetakPosyandu(Request $request)
    {
        $start = !empty($request->start) ? $request->start : null;
        $end = !empty($request->end) ? $request->end : null;

        $posko_id = (int)$request->posko_id > 0 ? (int)$request->posko_id : 0;
        $min_usia = (int)$request->min_usia > 0 ? (int)$request->min_usia : 0;
        $max_usia = (int)$request->max_usia > 0 ? (int)$request->max_usia : 0;
        $no = 1;
        $today = now();
        $where = array();

        if ($posko_id > 0) {
            $where += array('posko_id' => $posko_id);
        }
        if (Auth::user()->role_id == 2) {
            $where += array('posko_id' => Auth::user()->posko_id);
        }

        $data = $this->posyanduRepository->cetak($where, $start, $end, $min_usia, $max_usia);
        // dd($data);
        return view('laporan.cetakPosyandu', compact('no', 'data', 'today'));
    }
}
