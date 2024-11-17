@extends('layouts.master')
@section('css')

@endsection
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    @if(Auth::user()->role_id !== 4)
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Data Detail Posko Posyandu </h5>
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe" style="margin-bottom: 70px;">
                        <tbody>
                            <th>Peserta posyandu</th>
                            <th>: {{$anggota}} Orang</th>
                            <th>Peserta Belum Dapat Vitamin</th>
                            <th>: {{$vitamin}} Orang</th>
                        </tbody>
                        <tbody>
                            <th>Peserta Posyandu Bulan Ini</th>
                            <th>: {{$bulan_ini}} Orang</th>
                            <th>Peserta Belum Dapat imunisasi</th>
                            <th>: {{$imunisasi}} Orang</th>
                        </tbody>
                        <tbody>
                            <th>Peserta Lansia</th>
                            <th>: {{$lansia}} Orang</th>
                            <th>Balita Dengan Berat Badan Tidak Ideal</th>
                            <th>: {{$berat_tidak_ideal}} Orang</th>
                        </tbody>
                        <tbody>
                            <th>Peserta Balita</th>
                            <th>: {{$balita}} Orang</th>
                            <th>Balita Dengan Tinggi Badan Tidak Ideal</th>
                            <th>: {{$tinggi_tidak_ideal}} Orang</th>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif($message = Session::get('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Responsive Table -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Data Posko Posyandu </h5>
                    @if(Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Tambah Data</button>
                    @include('posyandu.create')
                    @else
                    @endif
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe" style="margin-bottom: 70px;" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Posko</th>
                                <th>Keluarga</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <th>{{$data->getPosko ? $data->getPosko->name : ''}}</th>
                                <th>{{$data->getAnggota ? $data->getAnggota->getKeluarga->nama_keluarga : ''}}</th>
                                <th>{{$data->getAnggota ? $data->getAnggota->nama_anggota : ''}}</th>
                                <th>{{$data->umur}}</th>
                                <th>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li> <a href="{{route('posyandu.detail',$data->id)}}" class="dropdown-item btn btn-primary my-1">Detail</a></li>
                                            @if(Auth::user()->role_id == 2)
                                            <li> <button type="button" class="dropdown-item btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{$data->id}}">Hapus</button></li>

                                            @endif
                                        </ul>
                                    </div>
                                </th>
                                @include('posyandu.delete')
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Responsive Table -->
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(function() {
        $("#datepicker").datepicker();
    });

    window.onload = function() {
        $('#datepicker').on('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#umur').val(age);
        });
    }
</script>


<script>
    $('#keluarga').change(function() {
        var keluargaId = $(this).val();

        if (keluargaId) {
            $.ajax({
                type: "GET",
                url: "posyandu/getAnggota?keluarga=" + keluargaId,
                dataType: 'JSON',
                success: function(res) {
                    if (res) {
                        $("#anggota").empty();
                        $("#anggota").append('<option>---Pilih Anggota Keluarga---</option>');
                        $.each(res, function(nama_anggota, id) {
                            $("#anggota").append('<option value="' + id + '">' + nama_anggota + '</option>');
                        });
                    } else {
                        $("#anggota").empty();
                    }
                }
            });
        } else {
            $("#anggota").empty();
        }
    });

    $('#keluargaEdit').change(function() {
        var keluargaId = $(this).val();
        if (keluargaId) {
            $.ajax({
                type: "GET",
                url: "posyandu/getAnggota?keluarga=" + keluargaId,
                dataType: 'JSON',
                success: function(res) {
                    if (res) {
                        $("#anggotaEdit").empty();
                        $("#anggotaEdit").append('<option>---Pilih Anggota Keluarga---</option>');
                        $.each(res, function(nama_anggota, id) {
                            $("#anggotaEdit").append('<option value="' + id + '">' + nama_anggota + '</option>');
                        });
                    } else {
                        $("#anggotaEdit").empty();
                    }
                }
            });
        } else {
            $("#anggota").empty();
        }
    });
</script>

<script>
    var radios = document.querySelectorAll('input[type=radio][name="vitamin"]');
    var vitamin = document.getElementById("vitaminDetail");

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'Vyes') {
                vitamin.style.display = 'block';
            } else {
                vitamin.style.display = 'none';
            }
        });
    });
</script>
<script>
    var radios = document.querySelectorAll('input[type=radio][name="imunisasi"]');
    var imunisasi = document.getElementById("imunisasiDetail");

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'Iyes') {
                imunisasi.style.display = 'block';
            } else {
                imunisasi.style.display = 'none';
            }
        });
    });
</script>

<script>
    var radios = document.querySelectorAll('input[type=radio][name="obatDarah"]');
    var obatDarah = document.getElementById("obatDarahDetail");

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'Oyes') {
                obatDarah.style.display = 'block';
            } else {
                obatDarah.style.display = 'none';
            }
        });
    });
</script>
@endsection