<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\Keluarga;
use App\Models\Posko;
use App\Models\Posyandu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $no = 1;
        $today = now();
        $data = Jadwal::get();
        $posko = Posko::get()->count();
        $keluarga = Keluarga::get()->count();
        $anggota = Anggota::get()->count();
        $account = User::whereNot('role_id', 1)->get()->count();
        $kegiatan = Jadwal::get()->count();
        $kegiatanComplete = Jadwal::where('tanggal', '<=', $today)->get()->count();
        $kegiatanNotComplete = Jadwal::where('tanggal', '>=', $today)->get()->count();
        $posyandu = Posyandu::get()->count();

        if (Auth::user()->role_id == 4) {
            $jadwal = Jadwal::where('posko_id', Auth::user()->posko_id)->whereDate('tanggal', '>=', Carbon::today())
                ->orderBy('tanggal', 'asc')->get();
            $user = Anggota::where('keluarga_id', Auth::user()->keluarga_id)->get();
            $anggotaKeluarga = Anggota::where('keluarga_id', Auth::user()->keluarga_id)->get();
            $imunisasi = [];
            foreach ($anggotaKeluarga as $anggota) {
                $alert = Jadwal::where('posko_id', Auth::user()->posko_id)->where('kategori', $anggota->umur)->whereDate('tanggal', '>=', Carbon::today())
                    ->orderBy('tanggal', 'asc')->first();
                $tanggal = isset($alert->tanggal) ? $alert->tanggal->format('d-m-Y') : null;
                $start = $alert->start ?? null;
                $finish = $alert->finish ?? null;
                if ($alert) {
                    if ($anggota->umur  <= 20 && $anggota->umur > 0) {

                        switch ($anggota->umur) {
                            case 1:
                                $imunisasi[] = 'Akan ada Imunisasi BCG, Polio 1 untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            case 2:
                                $imunisasi[] = 'Akan ada Imunisasi DPT-HB-Hib 1, Polio 2 untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            case 3:
                                $imunisasi[] = 'Akan ada Imunisasi DPT-HB-Hib 2, Polio 3 untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            case 4:
                                $imunisasi[] = 'Akan ada Imunisasi DPT-HB-Hib 3, Polio 4 untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            case 9:
                                $imunisasi[] = 'Akan ada Imunisasi Campak untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            case 18:
                                $imunisasi[] = 'Akan ada Imunisasi DPT-HB-Hib lanjutan dan MR lanjutan untuk ' . $anggota->nama_anggota . ' pada tanggal ' . $tanggal . ' yang akan dimulai pada jam ' . $start . ' sampai dengan jam ' . $finish . ' di posyandu yang terdatar';
                                break;
                            default:
                                $imunisasi[] = 'Tidak ada imunisasi yang dijadwalkan';
                                break;
                        }
                    }
                } else {
                    $imunisasi[] = 'Tidak ada imunisasi yang dijadwalkan';
                }
            }
        } else {
            $user = null;
            $jadwal = null;
            $imunisasi = null;
        }
        if (Auth::user()->role_id == 4) {

            $filteredData = array_filter($imunisasi, function ($item) {
                return !str_contains($item, 'Tidak ada imunisasi yang dijadwalkan');
            });
            $alert = implode(', ', $filteredData);
        } else {
            $alert = null;
        }




        if (Auth::user()->role_id == 1) {
            return view('dashboardAdmin', compact('data', 'jadwal', 'no', 'posko', 'keluarga', 'anggota', 'account', 'kegiatan', 'kegiatanComplete', 'kegiatanNotComplete', 'posyandu', 'user', 'alert'));
        } else {
            return view('dashboard', compact('user', 'jadwal', 'no', 'alert'));
        }
    }

    public function editProfile()
    {
        $data = User::where('id', Auth::user()->id)->first();
        return view('auth.editProfile', compact('data'));
    }
    public function updateProfile(Request $request)
    {
        $data = User::where('id', Auth::user()->id)->first();
        $data->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        return Redirect::back()->with('warning', 'user data updated successfully');
    }
    public function editPassword()
    {
        return view('auth.password');
    }
    public function updatePassword(Request $request)
    {
        $data = User::where('id', Auth::user()->id)->first();
        if (Hash::check($request->password_old, $data->password)) {
            $data->update([
                'password' => Hash::make($request->password_new),

            ]);
            return Redirect::back()->with('warning', 'Password data updated successfully');
        } else {
            return Redirect::back()->with('danger', 'The old password is not suitable');
        }
    }
}
