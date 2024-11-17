@extends('layouts.master')
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

            <div class="card mb-2">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Detail Keluarga</h5>
                    <a href="{{route('keluarga')}}" class="btn btn-danger">Kembali</a>
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table " style="margin-bottom: 70px;border: 1px;">
                        <thead>
                            <tr class="text-nowrap" style="border-width: 1px;">
                                <th>Nama Keluarga</th>
                                <th>: {{$keluarga->nama_keluarga}}</th>
                                <th>Nomor hp</th>
                                <th>: {{$keluarga->no_telpon}}</th>
                            </tr>
                            <tr class="text-nowrap" style="border-width: 1px;">
                                <th>Rw </th>
                                <th>: {{$keluarga->rw}}</th>
                                <th>Rt </th>
                                <th>: {{$keluarga->rt}}</th>
                            </tr>
                            <tr class="text-nowrap" style="border-width: 1px;">
                                <th>Alamat</th>
                                <th style="text-wrap: wrap;">: {{$keluarga->alamat}}</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Data Anggota Keluarga</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Tambah Data</button>
                    @include('anggota.create')
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe " style="margin-bottom: 70px;" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Nik</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <th>{{$data->nik}}</th>
                                <th>{{$data->nama_anggota}}</th>
                                <th>
                                    @if ($data->jenis_kelamin == 1)
                                    Laki Laki
                                    @elseif ($data->jenis_kelamin == 2)
                                    Perempuan
                                    @else
                                    @endif
                                </th>

                                <th>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li> <button type="button" class="dropdown-item btn btn-warning my-1" data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$data->id}}">Edit</button></li>
                                            <li> <button type="button" class="dropdown-item btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{$data->id}}">Hapus</button></li>

                                        </ul>
                                    </div>
                                </th>
                                @include('anggota.edit')
                                @include('anggota.delete')

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

@endsection