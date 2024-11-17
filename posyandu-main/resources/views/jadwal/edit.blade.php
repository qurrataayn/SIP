<div class="modal fade" id="exampleModaledit{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jadwal Posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('jadwal.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" value="{{$data->id}}" id="" hidden>
                    <div class="mb-3">
                        <label for="judul" class="col-form-label">Judul </label>
                        <input type="text" name="judul" class="form-control" value="{{$data->judul}}" placeholder="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="posko_id" class="col-form-label">Posko </label>
                        <select name="posko_id" class="form-control" id="" required>

                            @foreach ($posko as $posko)
                            <option value="{{$posko->id}}" {{ $posko->id == $data->posko_id ? 'selected' : '' }}>{{$posko->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="col-form-label">Kategori </label>
                        <select name="kategori" class="form-control" id="" required>
                            <option value="" disabled>Pilih Kategori Posyandu</option>
                            <option value="0" {{ $data->kategori == 0 ? 'selected' : '' }}>Umum</option>
                            <option value="1" {{ $data->kategori == 1 ? 'selected' : '' }}>BCG, Polio 1</option>
                            <option value="2" {{ $data->kategori == 2 ? 'selected' : '' }}>DPT-HB-Hib 1, Polio 2</option>
                            <option value="3" {{ $data->kategori == 3 ? 'selected' : '' }}>DPT-HB-Hib 2, Polio 3</option>
                            <option value="4" {{ $data->kategori == 4 ? 'selected' : '' }}>DPT-HB-Hib 3, Polio 4</option>
                            <option value="5" {{ $data->kategori == 5 ? 'selected' : '' }}>Campak</option>
                            <option value="6" {{ $data->kategori == 6 ? 'selected' : '' }}>DPT-HB-Hib lanjutan</option>
                            <option value="7" {{ $data->kategori == 7 ? 'selected' : '' }}>Lansia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="col-form-label">Tanggal </label>
                        <input type="date" name="tanggal" class="form-control" value="{{$data->tanggal}}" placeholder="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="start" class="col-form-label">start </label>
                        <input type="time" name="start" class="form-control" value="{{$data->start}}" placeholder="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="finish" class="col-form-label">finish </label>
                        <input type="time" name="finish" class="form-control" value="{{$data->finish}}" placeholder="finish" required>
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