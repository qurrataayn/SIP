@extends('layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
<div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Pertumbuhan Tinggi Badan {{ $user->nama_anggota }}</h5>
</div>
    <select class="form-control" id="familyDropdown">
        <option  value="">Pilih Keluarga</option>
        @foreach ($anggota as $family)
            <option value="{{ $family->id }}">{{ $family->nama_anggota }}</option>
        @endforeach
    </select>

    <div class="card">
            <h3>Grafik Berat Badan</h3>
            <canvas id="weightChart"></canvas>
    </div>

        <!-- Card untuk Tinggi Badan -->
    <div class="card">
            <h3>Grafik Tinggi Badan</h3>
            <canvas id="heightChart"></canvas>
    </div>
</div>
</div>
</div>

@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@1.28.0/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
<script>
     var weightChart = null;
        var heightChart = null;

        document.getElementById('familyDropdown').addEventListener('change', function () {
            var familyId = this.value;

            if (familyId) {
                fetch(`/grafik/families/${familyId}/weights`)
                    .then(response => response.json())
                    .then(data => {
                        updateWeightChart(data.dates, data.weights);
                        updateHeightChart(data.dates, data.heights);
                    });
            }
        });

        function updateWeightChart(dates, weights) {
            if (weightChart) {
                weightChart.destroy();
            }

            var ctx = document.getElementById('weightChart').getContext('2d');
            weightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Berat Badan',
                        data: weights,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true
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
        }

        function updateHeightChart(dates, heights) {
            if (heightChart) {
                heightChart.destroy();
            }

            var ctx = document.getElementById('heightChart').getContext('2d');
            heightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Tinggi Badan',
                        data: heights,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: true
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
        }
    </script>
@endsection