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
                    <h5 class="card-header">Data Jadwal Posyandu</h5>
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Tambah Data</button>
                    @include('jadwal.create')
                    @endif
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe" style="margin-bottom: 70px;" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>judul</th>
                                <th>Kategori</th>
                                <th>Posko</th>
                                <th>Tanggal</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <th>{{$data->judul}}</th>
                                <th>
                                    @if($data->kategori === 0)
                                    umum
                                    @elseif($data->kategori === 1)
                                    BCG, Polio 1
                                    @elseif($data->kategori === 2)
                                    DPT-HB-Hib 1, Polio 2
                                    @elseif($data->kategori === 3)
                                    DPT-HB-Hib 2, Polio 3
                                    @elseif($data->kategori === 4)
                                    DPT-HB-Hib 3, Polio 4
                                    @elseif($data->kategori === 5)
                                    Campak
                                    @elseif($data->kategori === 6)
                                    DPT-HB-Hib lanjutan
                                    @elseif($data->kategori === 7)
                                    Lansia
                                    @else
                                    tidak ada
                                    @endif

                                </th>
                                <th>{{$data->getPosko->name}}</th>
                                <th>{{$data->tanggal->format('d-m-Y')}}</th>
                                <th>{{$data->start}}</th>
                                <th>{{$data->finish}}</th>

                                <th>
                                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li> <button type="button" class="dropdown-item btn btn-warning my-1" data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$data->id}}">Edit</button></li>
                                            <li> <button type="button" class="dropdown-item btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{$data->id}}">Hapus</button></li>
                                        </ul>
                                    </div>
                                    @endif
                                </th>
                                @include('jadwal.edit')
                                @include('jadwal.delete')

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