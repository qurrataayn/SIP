@extends('layouts.master')
@section('css')

@endsection
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class=" col-md-12 order-1">
                <div class="row">
                    @if(Auth::user()->role_id == 4 )
                    <div class="card mb-2 " style="background-color: grey;">
                        <div class="p-4">
                            <div>
                                <h4 class="text-light">Pengingat:
                                </h4>
                                <hr>
                            </div>
                            <h6 class="text-light">
                                <b>
                                    {{$alert}}
                                </b>
                            </h6>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('keluarga')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/family.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Keluarga</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('user')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/account.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Account</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('jadwal')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/timetable.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Jadwal Kegiatan</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('posyandu')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/hospital.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1"> Posyandu</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('laporan.kegiatan')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/immigration.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1"> Laporan Kegiatan</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4 text-center">
                        <a href="{{route('laporan.posyandu')}}" class="text-secondary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-center">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/icon/health-check.png')}}" alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1"> Laporan Posyandu</span>
                                    <h3 class="card-title mb-2"></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
                @if(Auth::user()->role_id == 4 )

                <!-- Content -->
                <div class="row">
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center px-0">
                            <h5 class="card-header">Grafik Pertumbuhan Keluarga </h5>
                        </div>
                        <div class="container ">
                            <form action="">
                                <label for="">Pilih Anggota Keluarga</label>
                                <select class="form-control " id="familyDropdown">
                                    <option value="">Pilih Keluarga</option>
                                    @foreach ($user as $family)
                                    <option value="{{ $family->id }}">{{ $family->nama_anggota }}</option>
                                    @endforeach
                                </select>

                            </form>
                        </div>
                        <div class=" row p-4">
                            <div id="cardStatus" class="card d-flex  flex-row py-2">
                                <div class=" col-md-4 d-flex align-items-center">
                                    <p id="weightStatus" class="mb-0"></p> <!-- Status BMI ditampilkan di sini -->

                                </div>
                                <div class=" col-md-4 d-flex align-items-center">
                                    <p id="latestWeight" class="mb-0"></p> <!-- Berat badan terakhir -->

                                </div>
                                <div class=" col-md-4 d-flex align-items-center">

                                    <p id="latestHeight" class="mb-0"></p> <!-- Tinggi badan terakhir -->
                                </div>
                            </div>
                        </div>
                        <div class="row p-4">
                            <!-- Card untuk Berat Badan -->
                            <div class="card col-md-6 ">
                                <h3 class="text-center">Grafik Berat Badan</h3>
                                <canvas id="weightChart" class="mb-2"></canvas>

                            </div>

                            <!-- Card untuk Tinggi Badan -->
                            <div class="card col-md-6 ">
                                <h3 class="text-center">Grafik Tinggi Badan</h3>
                                <canvas id="heightChart" class="mb-2"></canvas>

                            </div>
                        </div>
                    </div>
                    <div class="row p-4">
                        <!-- Informasi Lanjutan -->
                        <div class="card my-2">
                            <div class="card-header">
                                <h5>Informasi Lanjutan</h5>
                            </div>
                            <div class="accordion" id="informasiLanjutan">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Apa Penyebabnya?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#informasiLanjutan">
                                        <div class="accordion-body">
                                            <!-- Isi penyebab di sini -->
                                            <p id="penyebab">Penyebab dari kondisi ini akan ditampilkan di sini.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Apa yang harus dilakukan?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#informasiLanjutan">
                                        <div class="accordion-body">
                                            <!-- Isi tindakan yang harus dilakukan di sini -->
                                            <p id="tindakan">Rekomendasi tindakan akan ditampilkan di sini.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Berapa Angka yang Ideal?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#informasiLanjutan">
                                        <div class="accordion-body">
                                            <!-- Isi angka ideal di sini -->
                                            <p id="angkaIdeal">Angka ideal berat badan akan ditampilkan di sini.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Risiko Kesehatan
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#informasiLanjutan">
                                        <div class="accordion-body">
                                            <!-- Isi risiko kesehatan di sini -->
                                            <p id="risikoKesehatan">Risiko kesehatan terkait kondisi ini akan ditampilkan di sini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-2">
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <h5 class="card-header">Data Jadwal Posyandu</h5>

                        </div>
                        <div class="table-responsive text-nowrap  px-4">
                            <table class="table cell-border compact stripe" style="margin-bottom: 70px;" id="myTable">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th>No</th>
                                        <th>judul</th>
                                        <th>Posko</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $data)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <th>{{$data->judul}}</th>
                                        <th>{{$data->getPosko->name}}</th>
                                        <th>{{$data->tanggal->format('d-m-Y')}}</th>
                                        <th>{{$data->start}}</th>
                                        <th>{{$data->finish}}</th>



                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @endif
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
    document.addEventListener('DOMContentLoaded', function() {
        var weightChart = null;
        var heightChart = null;

        document.getElementById('familyDropdown').addEventListener('change', function() {
            var familyId = this.value;

            if (familyId) {
                fetch(`/grafik/families/${familyId}/weights`)
                    .then(response => response.json())
                    .then(data => {
                        updateWeightChart(data.dates, data.weights);
                        updateHeightChart(data.dates, data.heights);
                        displayBmiStatus(data.bmiStatuses, data.heights);
                        displayAdditionalInfo(data.bmiStatuses[data.bmiStatuses.length - 1], data.ideal); // Memanggil informasi tambahan berdasarkan BMI terakhir
                        displayLatestData(data.weights, data.heights, data.bmiStatuses[data.bmiStatuses.length - 1]);
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
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
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
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function displayBmiStatus(bmiStatuses, heights) {
            var weightStatus = document.getElementById('weightStatus');
            var latestStatus = bmiStatuses[bmiStatuses.length - 1]; // Ambil status BMI terbaru
            weightStatus.textContent = 'Status Berat Badan: ' + latestStatus;

            // Tambahkan logika untuk status tinggi badan
            var heightStatus = document.getElementById('heightStatus');
            var latestHeight = heights[heights.length - 1]; // Ambil tinggi badan terbaru

            if (heightStatus) {
                if (latestHeight < 150) {
                    heightStatus.textContent = 'Status Tinggi Badan: Pendek';
                } else if (latestHeight >= 150 && latestHeight <= 180) {
                    heightStatus.textContent = 'Status Tinggi Badan: Normal';
                } else {
                    heightStatus.textContent = 'Status Tinggi Badan: Tinggi';
                }
            }

        }

        function displayLatestData(weights, heights, bmiStatus) {
            var latestWeight = parseFloat(weights[weights.length - 1]).toFixed(2).replace(/\.?0+$/, '');
            var latestHeight = parseFloat(heights[heights.length - 1]).toFixed(2).replace(/\.?0+$/, '');

            document.getElementById('latestWeight').textContent = 'Berat Badan Terakhir: ' + latestWeight + ' kg';
            document.getElementById('latestHeight').textContent = 'Tinggi Badan Terakhir: ' + latestHeight + ' cm';

            var cardElement = document.getElementById('cardStatus');
            console.log(bmiStatus)
            // Atur warna berdasarkan tinggi badan terbaru
            switch (bmiStatus) {
                case 'Kurang':
                    cardElement.classList.remove('bg-danger');
                    cardElement.classList.add('bg-danger');
                    break;
                case 'Ideal':
                    cardElement.classList.remove('bg-danger');
                    cardElement.classList.add('bg-success');
                    break;
                case 'Berlebih':
                    cardElement.classList.remove('bg-danger');
                    cardElement.classList.add('bg-danger');
                    break;
                case 'Obesitas':
                    cardElement.classList.remove('bg-danger');
                    cardElement.classList.add('bg-danger');
                    break;
                default:

                    break;

            }
        }


    });

    function displayAdditionalInfo(bmiStatus, idealWeight) {
        const penyebab = document.getElementById('penyebab');
        const tindakan = document.getElementById('tindakan');
        const angkaIdeal = document.getElementById('angkaIdeal');
        const risikoKesehatan = document.getElementById('risikoKesehatan');

        console.log(idealWeight)
        // Contoh logika untuk menampilkan informasi berdasarkan status BMI
        switch (bmiStatus) {
            case 'Kurang':
                penyebab.textContent = 'Asupan nutrisi kurang, pola makan tidak teratur, penyakit tertentu (misalnya: infeksi, alergi, gangguan pencernaan), genetik.';
                tindakan.textContent = 'Tingkatkan asupan nutrisi dengan memberikan makanan bergizi seimbang (karbohidrat, protein, lemak, vitamin, dan mineral) sesuai usia. Konsultasikan dengan dokter atau ahli gizi untuk pengaturan pola makan dan penanganan jika ada penyakit penyerta. Pantau perkembangan berat badan secara berkala.';
                angkaIdeal.textContent = 'Berat ideal untuk usia ini adalah ' + idealWeight +
                    ' kg .';
                risikoKesehatan.textContent = 'Rentan terhadap infeksi, gangguan pertumbuhan dan perkembangan, daya tahan tubuh lemah.';
                break;
            case 'Ideal':
                penyebab.textContent = 'Asupan nutrisi seimbang dan sesuai kebutuhan, pola makan teratur, pertumbuhan dan perkembangan yang optimal.';
                tindakan.textContent = 'Pertahankan pola makan sehat dan seimbang, penuhi kebutuhan nutrisi sesuai usia, ajak balita aktif bergerak. Pantau terus pertumbuhan dan perkembangannya di Posyandu.';
                angkaIdeal.textContent = 'Berat dan tinggi badan sudah ideal, pertahankan kebiasaan baik yang ada.';
                risikoKesehatan.textContent = 'Risiko penyakit relatif rendah. Mempertahankan status gizi normal penting untuk mencegah penyakit di kemudian hari.';
                break;
            case 'Berlebih':
                penyebab.textContent = 'Asupan kalori berlebih, konsumsi makanan tinggi gula dan lemak, kurang aktivitas fisik, faktor genetik.';
                tindakan.textContent = 'Batasi konsumsi makanan tinggi gula dan lemak, tingkatkan konsumsi buah dan sayur, ajak balita aktif bergerak dan bermain, konsultasikan dengan dokter atau ahli gizi untuk pengaturan pola makan.';
                angkaIdeal.textContent = 'Berat ideal untuk usia ini adalah ' + idealWeight +
                    'kg .';
                risikoKesehatan.textContent = 'Berisiko terkena diabetes, penyakit jantung, tekanan darah tinggi, gangguan pernapasan, dan masalah sendi di kemudian hari.';
                break;
            case 'Obesitas':
                penyebab.textContent = 'Asupan kalori berlebih, konsumsi makanan tinggi gula dan lemak, kurang aktivitas fisik, faktor genetik.';
                tindakan.textContent = 'Batasi konsumsi makanan tinggi gula dan lemak, tingkatkan konsumsi buah dan sayur, ajak balita aktif bergerak dan bermain, konsultasikan dengan dokter atau ahli gizi untuk pengaturan pola makan.';
                angkaIdeal.textContent = 'Berat ideal untuk usia ini adalah ' + idealWeight +
                    ' kg .';
                risikoKesehatan.textContent = 'Berisiko terkena diabetes, penyakit jantung, tekanan darah tinggi, gangguan pernapasan, dan masalah sendi di kemudian hari.';
                break;
            default:
                penyebab.textContent = 'Informasi tidak tersedia.';
                tindakan.textContent = 'Informasi tidak tersedia.';
                angkaIdeal.textContent = 'Informasi tidak tersedia.';
                risikoKesehatan.textContent = 'Informasi tidak tersedia.';
                break;
        }
    }
</script>
<script>

</script>
@endsection