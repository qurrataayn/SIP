<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Posko Posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('posko.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nama </label>
                        <input type="text" name="name" class="form-control" placeholder="name">
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="col-form-label">Kota </label>
                        <input type="text" name="kota" class="form-control" placeholder="Kota">
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="col-form-label">Kecamatan </label>
                        <input type="text" name="kecamatan" class="form-control" placeholder="kecamatan">
                    </div>
                    <div class="mb-3">
                        <label for="kelurahan" class="col-form-label">Kelurahan </label>
                        <input type="text" name="kelurahan" class="form-control" placeholder="kelurahan">
                    </div>
                    <div class="mb-3">
                        <label for="rw" class="col-form-label">Rw </label>
                        <input type="number" name="rw" class="form-control" placeholder="rw">
                    </div>
                    <div class="mb-3">
                        <label for="rt" class="col-form-label">Rt </label>
                        <input type="number" name="rt" class="form-control" placeholder="rt">
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