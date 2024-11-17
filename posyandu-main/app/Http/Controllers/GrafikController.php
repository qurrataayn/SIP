<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function BeratBadan($id)
    {
        $user = Anggota::where('id', $id)->first();
        $weightRecords = Posyandu::where('anggota_id', $id)->orderBy('created_at')->limit(12)->get();

        // Ambil data tanggal dan berat badan
        $dates = $weightRecords->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });
        $weights = $weightRecords->pluck('berat_badan');

        // Kirim data ke view
        return view('grafik.beratBadan', compact('dates', 'weights', 'user'));
    }

    public function TinggiBadan($id)
    {
        $anggota = Anggota::get();
        $user = Anggota::where('id', $id)->first();
        $weightRecords = Posyandu::where('anggota_id', $id)->orderBy('created_at')->limit(12)->get();

        // Ambil data tanggal dan berat badan
        $dates = $weightRecords->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });
        $tinggiBadan = $weightRecords->pluck('tinggi_badan');

        // Kirim data ke view
        return view('grafik.tinggiBadan', compact('dates', 'tinggiBadan', 'user', 'anggota'));
    }


    public function getFamilyWeights($id)
    {
        // Ambil data berat dan tinggi badan dari tabel Posyandu
        $records = Posyandu::where('anggota_id', $id)->orderBy('created_at')->limit(12)->get();

        // Ambil data tanggal
        $dates = $records->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        });

        // Ambil data berat badan dan tinggi badan
        $weights = $records->pluck('berat_badan');
        $heights = $records->pluck('tinggi_badan');

        // Inisialisasi array untuk menyimpan status ideal
        $bmiStatuses = [];

        foreach ($weights as $index => $weight) {
            $heightInMeters = $heights[$index] / 100; // Konversi tinggi badan ke meter
            $bmi = $weight / ($heightInMeters * $heightInMeters); // Hitung BMI

            // Tentukan status BMI
            if ($bmi < 18.5) {
                $status = 'Kurang';
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $status = 'Ideal';
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                $status = 'Berlebih';
            } else {
                $status = 'Obesitas';
            }

            $bmiStatuses[] = $status;
        }

        $people = Posyandu::where('anggota_id', $id)->orderBy('created_at')->first();
        if ($people) {
            if ($people->getAnggota->jenis_kelamin = 1) {
                // Rumus Devine untuk pria
                $idealWeight = 50 + 0.9 * ($people->tinggi_badan - 152.4);
            } elseif ($people->getAnggota->jenis_kelamin = 2) {
                // Rumus Devine untuk wanita
                $idealWeight = 45.5 + 0.9 * ($people->tinggi_badan - 152.4);
            } else {
                return "Invalid gender";
            }
        } else {
            $idealWeight = null;
        }

        // Kembalikan data dalam bentuk JSON
        return response()->json([
            'dates' => $dates,
            'weights' => $weights,
            'heights' => $heights,
            'bmiStatuses' => $bmiStatuses, // Tambahkan status BMI
            'ideal' => round($idealWeight)
        ]);
    }
}
