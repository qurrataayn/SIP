<div class="modal fade" id="exampleModaledit{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('artikel.createOrUpdate',$data->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input name="id" value="{{$data->id}}" hidden>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Image </label>
                        <input type="file" name="image" class="form-control" placeholder="image">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Judul </label>
                        <input type="text" name="judul" value="{{$data->judul}}" class="form-control" placeholder="Title">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="col-form-label">Kategori </label>
                        <select name="kategori_id" id="" class="form-control">

                            @foreach ($kategori as $kategori)
                            <option value="{{$kategori->id}}" {{ $kategori->id == $data->kategori_id ? 'selected' : '' }}>{{$kategori->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Deskripsi </label>
                        <textarea name="deskripsi" id="editor-edit" class="form-control" cols="30" rows="5">{{$data->deskripsi}}</textarea>
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