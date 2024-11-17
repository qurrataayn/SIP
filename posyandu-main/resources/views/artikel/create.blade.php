<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('artikel.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Gambar </label>
                        <input type="file" name="image" class="form-control" placeholder="Gambar">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Judul </label>
                        <input type="text" name="judul" class="form-control" placeholder="judul">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Kategori </label>
                        <Select class="form-control" name="kategori_id">
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach($kategori as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                            @endforeach
                        </Select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Deskripsi </label>
                        <textarea type="text" id="editor" name="deskripsi" class="form-control">Deskripsi</textarea>
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