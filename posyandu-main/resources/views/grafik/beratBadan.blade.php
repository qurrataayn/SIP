@extends('layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
<div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Pertumbuhan Berat Badan {{ $user->nama_anggota }}</h5>
</div>
    <canvas id="weightGrowthChart" width="400" height="200"></canvas>
    
</div>
</div>
</div>

@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@1.28.0/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
<script>
        var ctx = document.getElementById('weightGrowthChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!}, // Data untuk tanggal (x-axis)
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: {!! json_encode($weights) !!}, // Data berat badan (y-axis)
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time', // Skala waktu
                        time: {
                            unit: 'month' // Menggunakan bulan sebagai unit
                        }
                    },
                    y: {
                        beginAtZero: true // Dimulai dari nol
                    }
                }
            }
        });
    </script>
@endsection