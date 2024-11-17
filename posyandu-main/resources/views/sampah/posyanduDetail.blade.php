@extends('layouts.master')
@section('css')

@endsection
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <!-- Responsive Table -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center ">
                    <h5 class="card-header">Data Detail Posyandu </h5>
                    <a href="{{route('sampah.posyandu')}}" class="btn btn-danger">Kembali</a>
                </div>
                <div class="table-responsive text-nowrap  ">
                    <table class="table cell-border compact stripe" style="margin-bottom: 70px;">
                        <thead>
                            <tr class="text-nowrap">
                                <th> Keluarga</th>
                                <th>{{$data->getAnggota ? $data->getAnggota->getKeluarga->nama_keluarga : ''}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th> Anggota</th>
                                <th>{{$data->getAnggota ? $data->getAnggota->nama_anggota : ''}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Posko </th>
                                <th>{{$data->getPosko ? $data->getPosko->name : ''}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Tanggal Lahir </th>
                                <th>{{$data->tanggal_lahir}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Umur </th>
                                <th>{{$data->umur}} Tahun</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Tinggi Badan </th>
                                <th>{{$data->tinggi_badan}} cm</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Berat Badan </th>
                                <th>{{$data->berat_badan}} Kg</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Lingkar Lengan </th>
                                <th>{{$data->lingkar_lengan}} cm</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Lingkar Kepala </th>
                                <th>{{$data->lingkar_kepala}} cm</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Tekanan Darah </th>
                                <th>{{$data->tekanan_darah}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Imunisasi </th>
                                <th>{{$data->imunisasi}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Vitamin </th>
                                <th>{{$data->vitamin}}</th>
                            </tr>
                            <tr class="text-nowrap">
                                <th>Obat Tambah Darah </th>
                                <th>{{$data->obat_tambah_darah}}</th>
                            </tr>
                        </thead>
                        <tbody>

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