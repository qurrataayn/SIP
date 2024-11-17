@extends('layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class=" col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/hospital.png')}}" alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Posko Posyandu</span>
                                <h3 class="card-title mb-2">{{$posko}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/family.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Keluarga</span>
                                <h3 class="card-title text-nowrap mb-1">{{$keluarga}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/member.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Anggota Keluarga</span>
                                <h3 class="card-title text-nowrap mb-1">{{$anggota}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/account.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Akun</span>
                                <h3 class="card-title text-nowrap mb-1">{{$account}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/timetable.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Kegiatan</span>
                                <h3 class="card-title text-nowrap mb-1">{{$kegiatan}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/calendar.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Kegiatan Belum Selesai</span>
                                <h3 class="card-title text-nowrap mb-1">{{$kegiatanNotComplete}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/complete.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Kegiatan Sudah Selesai</span>
                                <h3 class="card-title text-nowrap mb-1">{{$kegiatanComplete}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{asset('/assets/icon/exploration.png')}}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>Data Posyandu</span>
                                <h3 class="card-title text-nowrap mb-1">{{$posyandu}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <!-- Responsive Table -->
                    <div class="card">
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
                                    @foreach ($data as $data)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <th>{{$data->judul}}</th>
                                        <th>{{$data->getPosko->name}}</th>
                                        <th>{{$data->tanggal}}</th>
                                        <th>{{$data->start}}</th>
                                        <th>{{$data->finish}}</th>
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
    </div>
</div>
@endsection