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
            <div class="card">
                <div class="d-flex justify-content-between align-items-center px-3">
                    <h5 class="card-header">Data Keluarga</h5>
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Tambah Data</button>
                    @include('keluarga.create')
                    @endif
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe " style="margin-bottom: 70px;" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Keluarga</th>
                                <th>No Telepon</th>
                                <th style="width: 25%;">Alamat</th>
                                <th>Rt</th>
                                <th>Rw</th>
                                <th>Total Anggota</th>
                                <th>Posko Posyandu</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <th>{{$data->nama_keluarga}}</th>
                                <th>{{$data->no_telpon}}</th>
                                <th style="text-wrap: wrap;">{{$data->alamat}}</th>
                                <th>{{$data->rw}}</th>
                                <th>{{$data->rt}}</th>
                                <th>{{$data->jumlah_anggota}}</th>
                                <th>{{$data->getUser ? $data->getUser->getPosko->name : ''}}</th>

                                <th>
                                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li> <button type="button" class="dropdown-item btn btn-warning my-1" data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$data->id}}">Edit</button></li>
                                            <li><a class="btn btn-primary" href="{{route('anggota',$data->id)}}">Daftar Anggota</a></li>
                                        </ul>
                                    </div>
                                    @endif
                                </th>
                                @include('keluarga.edit')

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