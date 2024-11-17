<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Anggota Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('anggota.createOrUpdate',$keluarga->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="col-form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Keluarga" maxlength="16">
                    </div>
                    <div class="mb-3">
                        <label for="nama_anggota" class="col-form-label">Nama Anggota</label>
                        <input type="text" name="nama_anggota" class="form-control" placeholder="nama anggota">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="col-form-label">Jenis_kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="">
                            <option value="1">Laki Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>