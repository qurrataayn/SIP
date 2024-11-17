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
                    <h5 class="card-header">Data Akun</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModaladd">Tambah Data</button>
                    @include('user.create')
                </div>
                <div class="table-responsive text-nowrap  px-4">
                    <table class="table cell-border compact stripe " style="margin-bottom: 70px;" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Keluarga</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <th>{{$data->username}}</th>
                                <th>{{$data->email}}</th>
                                <th>{{$data->getRole->name}}</th>
                                <th>{{$data->keluarga_id ? $data->getKeluarga->nama_keluarga : ''}}</th>
                                <th>

                                    @if ($data->is_active == 1)
                                    <span class="badge rounded-pill bg-success">Aktif</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Nonaktif</span>
                                    @endif
                                </th>
                                <th>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu p-3">

                                            <li>
                                                <button type="button" class="dropdown-item btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#exampleModalReset{{$data->id}}">
                                                    Reset Password
                                                </button>
                                            </li>
                                            <li> <button type="button" class="dropdown-item btn btn-warning my-1" data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$data->id}}">Edit</button></li>
                                            <li>
                                                <button type="button" class="dropdown-item btn btn-info my-1" data-bs-toggle="modal" data-bs-target="#exampleModalStatus{{$data->id}}">
                                                    Update Status
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                @include('user.edit')
                                @include('user.resetPassword')
                                @include('user.updateStatus')
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
    function showAdditionalFields() {
        var roleSelect = document.getElementById("role");
        var additionalFieldsDiv = document.getElementById("additionalFields");
        var additionalFieldsPoskoDiv = document.getElementById("additionalFieldsPosko");

        if (roleSelect.value === "4") {
            additionalFieldsDiv.style.display = "block";
            additionalFieldsPoskoDiv.style.display = "block";

        } else if (roleSelect.value === "2") {
            additionalFieldsDiv.style.display = "none";
            additionalFieldsPoskoDiv.style.display = "block";
        } else {
            additionalFieldsPoskoDiv.style.display = "none";
            additionalFieldsDiv.style.display = "none";
        }
    }
</script>
@endsection