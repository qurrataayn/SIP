<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Data Jadwal Posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('laporan.kegiatan.cetak')}}" target="_blank" enctype="multipart/form-data">
                    @csrf
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 3 )
                    <div class="mb-3">
                        <label for="posko_id" class="col-form-label">Posko </label>
                        <select name="posko_id" class="form-control" id="">
                            <option value="">Semua Posko</option>
                            @foreach ($posko as $posko)
                            <option value="{{$posko->id}}">{{$posko->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="tanggal" class="col-form-label">Tanggal Awal </label>
                        <input type="date" name="start" class="form-control" placeholder="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="col-form-label">Tanggal Akhir</label>
                        <input type="date" name="end" class="form-control" placeholder="tanggal">
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>