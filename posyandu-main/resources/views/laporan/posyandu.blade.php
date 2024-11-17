@extends('layouts.master')
@section('css')

@endsection
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

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
                    <h5 class="card-header">Laporan Data Posyandu </h5>

                    <button type="button" class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Cetak </button>
                    @include('laporan.filterPosyandu')
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
                                <th>Tanggal</th>
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
                                <th>{{$data->created_at->format('d-m-Y')}}</th>
                                <th>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li> <a href="{{route('laporan.posyandu.detail',$data->id)}}" class="dropdown-item btn btn-primary my-1">Detail</a></li>

                                        </ul>
                                    </div>
                                </th>

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