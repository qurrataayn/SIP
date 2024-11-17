<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Keluarga;
use App\Models\Posyandu;
use App\Repositories\AnggotaRepository;
use App\Repositories\KeluargaRepository;
use App\Repositories\PosyanduRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PosyanduController extends Controller
{
    public function __construct(
        PosyanduRepository $posyanduRepository,
        KeluargaRepository $keluargaRepository,
        AnggotaRepository $anggotaRepository

    ) {
        $this->posyanduRepository = $posyanduRepository;
        $this->keluargaRepository = $keluargaRepository;
        $this->anggotaRepository = $anggotaRepository;
    }

    public function index(): View
    {
        $where = array(
            'posko_id' => Auth::user()->posko_id
        );


        $no = 1;
        if (Auth::user()->role_id == 2) {
            $data = $this->posyanduRepository->whereData($where)->get();
            $vitamin_count = $this->posyanduRepository->whereData($where)->select('anggota_id')->whereNotNull('vitamin')->groupBy('anggota_id')->get()->count();
            $imunisasi_count = $this->posyanduRepository->whereData($where)->select('anggota_id')->whereNotNull('imunisasi')->groupBy('anggota_id')->get()->count();
            $lansia = $this->posyanduRepository->whereData($where)->select('anggota_id')->whereDate('tanggal_lahir', '<=', Carbon::now()->subYears(60))->groupBy('anggota_id')->get()->count();
            $balita = $this->posyanduRepository->whereData($where)->select('anggota_id')->whereDate('tanggal_lahir', '>=', Carbon::now()->subYears(5))->groupBy('anggota_id')->get()->count();
            $bulan_ini = $this->posyanduRepository->whereData($where)->select('anggota_id')->whereMonth('created_at', Carbon::now()->month)->groupBy('anggota_id')->get()->count();
            $keluarga = $this->keluargaRepository->posko($where);
            $anggota = $this->keluargaRepository->count_anggota($where);
            $vitamin = $anggota - $vitamin_count;
            $imunisasi = $anggota - $imunisasi_count;
            $berat_badan = Posyandu::where('umur', '<=', 5)->where('posko_id', Auth::user()->posko_id)->whereMonth('created_at', Carbon::now()->month)->select('anggota_id')->groupBy('anggota_id')->get();

            // Hitung jumlah balita dengan berat badan ideal
            $berat_ideal = $berat_badan->filter(function ($berat) {
                return $berat->isIdealWeightForToddler();
            })->count();
            $berat_tidak_ideal = $balita - $berat_ideal;

            $tinggi_badan = Posyandu::where('umur', '<=', 5)->where('posko_id', Auth::user()->posko_id)->whereMonth('created_at', Carbon::now()->month)->select('anggota_id')->groupBy('anggota_id')->get();
            // Hitung jumlah balita dengan tinggi badan ideal
            $tinggi_ideal = $tinggi_badan->filter(function ($user) {
                return $user->isIdealHeightForToddler();
            })->count();

            $tinggi_tidak_ideal = $balita - $tinggi_ideal;
        } elseif (Auth::user()->role_id == 4) {
            $keluarga_id = Auth::user()->keluarga_id;
            $data = $this->posyanduRepository->whereKeluarga($keluarga_id)->get();
            $keluarga = null;
            $anggota = null;
            $lansia = null;
            $balita = null;
            $vitamin = null;
            $bulan_ini = null;
            $imunisasi = null;
            $berat_tidak_ideal = null;
            $tinggi_tidak_ideal = null;
        } else {
            $data = $this->posyanduRepository->getData();
            $anggota = $this->keluargaRepository->countData();
            $vitamin_count = Posyandu::select('anggota_id')->whereNotNull('vitamin')->groupBy('anggota_id')->get()->count();
            $imunisasi_count = Posyandu::select('anggota_id')->whereNotNull('imunisasi')->groupBy('anggota_id')->get()->count();
            $lansia = Posyandu::select('anggota_id')->whereDate('tanggal_lahir', '<=', Carbon::now()->subYears(60))->groupBy('anggota_id')->get()->count();
            $balita = Posyandu::select('anggota_id')->whereDate('tanggal_lahir', '>=', Carbon::now()->subYears(5))->groupBy('anggota_id')->get()->count();
            $bulan_ini = Posyandu::select('anggota_id')->whereMonth('created_at', Carbon::now()->month)->groupBy('anggota_id')->get()->count();


            $keluarga = null;
            $vitamin = $anggota - $vitamin_count;
            $imunisasi = $anggota - $imunisasi_count;

            $berat_badan = Posyandu::where('umur', '<=', 5)->whereMonth('created_at', Carbon::now()->month)->get();
            // Hitung jumlah balita dengan berat badan ideal
            $berat_ideal = $berat_badan->filter(function ($berat) {
                return $berat->isIdealWeightForToddler();
            })->select('anggota_id')->groupBy('anggota_id')->count();
            $berat_tidak_ideal = $balita - $berat_ideal;

            $tinggi_badan = Posyandu::where('umur', '<=', 5)->whereMonth('created_at', Carbon::now()->month)->get();
            $tinggi_ideal = $tinggi_badan->filter(function ($user) {
                return $user->isIdealHeightForToddler();
            })->count();

            $tinggi_tidak_ideal = $balita - $tinggi_ideal;
            // dd($balita, $berat_ideal, $tinggi_tidak_ideal, $tinggi_ideal);
        }

        return view('posyandu.index', compact('no', 'data', 'keluarga', 'anggota', 'vitamin', 'imunisasi', 'lansia', 'balita', 'bulan_ini', 'berat_tidak_ideal', 'tinggi_tidak_ideal'));
    }

    public function getAnggota(Request $request)
    {
        $where = array(
            'keluarga_id' => $request->keluarga
        );
        $anggota = $this->anggotaRepository->whereData($where)->pluck('id', 'nama_anggota');

        return response()->json($anggota);
    }

    public function storeAndUpdate(Request $request)
    {

        $id = (int)$request->id > 0 ? (int)$request->id : 0;
        $validator = Validator::make($request->all(), $this->rules($id));

        if ($validator->fails()) {
            // dd($validator->errors()->get('*'));
            return redirect(route('posyandu'))->with('danger', $validator->errors()->first('*'));
        }

        if ($id) {
            $request->request->add(['vitamin' => $request->vitaminEdit]);
            $request->request->add(['imunisasi' => $request->imunisasiEdit]);
            $request->request->add(['obat_tambah_darah' => $request->obat_tambah_darah_edit]);
        }

        $request->request->add(['posko_id' => Auth::user()->posko_id]);
        $request->request->add(['created_by' => Auth::user()->id]);
        $data = $this->posyanduRepository->CreateOrUpdate($request->all(), $id);

        if ($id == 0) {
            return redirect(route('posyandu'))->with('success', 'data posyandu posyandu berhasil di tambahkan');
        } else {
            return redirect(route('posyandu'))->with('warning', 'data posyandu posyandu berhasil di edit');
        }
        return redirect();
    }

    function detail($id)
    {
        $data = $this->posyanduRepository->find($id);
        return view('posyandu.detail', compact('data'));
    }
    public function delete($id)
    {
        if ($id == 0) {
            return redirect(route('posyandu'))->with('danger', 'data posyandu posyandu tidak ditemukan');
        }
        $data = $this->posyanduRepository->delete($id);
        return redirect(route('posyandu'))->with('danger', 'data posyandu posyandu berhasil di hapus');
    }
    private function rules($id)
    {
        return [
            'anggota_id' => ['required'],
            'tanggal_lahir' => ['required'],
            'tinggi_badan' => ['required'],
            'berat_badan' => ['required'],
            'lingkar_lengan' => [],
            'lingkar_kepala' => [],
            'imunisasi' => [],
            'vitamin' => [],
            'tekanan_darah' => [],
            'obat_tambah_darah' => [],
        ];
    }
}
