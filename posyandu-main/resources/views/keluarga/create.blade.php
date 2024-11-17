<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('keluarga.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_keluarga" class="col-form-label">Nama Keluarga</label>
                        <input type="text" name="nama_keluarga" class="form-control" placeholder="nama_keluarga">
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="col-form-label">No telepon</label>
                        <input type="number" class="form-control" name="no_telpon" id="" placeholder="08XXXXXXXX">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="col-form-label">alamat</label>
                        <input type="text" class="form-control" name="alamat" id="" placeholder="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="rw" class="col-form-label">RW</label>
                        <input type="number" class="form-control" name="rw" id="" placeholder="rw">
                    </div>
                    <div class="mb-3">
                        <label for="rt" class="col-form-label">Rt</label>
                        <input type="number" class="form-control" name="rt" id="" placeholder="rt">
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