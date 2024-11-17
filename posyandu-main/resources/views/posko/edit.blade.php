<div class="modal fade" id="exampleModaledit{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Posko Posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('posko.createOrUpdate',$data->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input name="id" value="{{$data->id}}" hidden>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nama </label>
                        <input type="text" name="name" class="form-control" value="{{$data->name}}" placeholder="name">
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="col-form-label">Kota </label>
                        <input type="text" name="kota" class="form-control" value="{{$data->kota}}" placeholder="Kota">
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="col-form-label">Kecamatan </label>
                        <input type="text" name="kecamatan" class="form-control" value="{{$data->kecamatan}}" placeholder="kecamatan">
                    </div>
                    <div class="mb-3">
                        <label for="kelurahan" class="col-form-label">Kelurahan </label>
                        <input type="text" name="kelurahan" class="form-control" value="{{$data->kelurahan}}" placeholder="kelurahan">
                    </div>
                    <div class="mb-3">
                        <label for="rw" class="col-form-label">Rw </label>
                        <input type="number" name="rw" class="form-control" value="{{$data->rw}}" placeholder="rw">
                    </div>
                    <div class="mb-3">
                        <label for="rt" class="col-form-label">Rt </label>
                        <input type="number" name="rt" class="form-control" value="{{$data->rt}}" placeholder="rt">
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