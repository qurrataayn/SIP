<div class="modal fade" id="exampleModalRestore{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Memulihkan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-wrap">

                <h6>

                    Apakah anda yakin ingin mengembalikan data jadwal posyandu dengan judul {{$data->judul}} ?
                </h6>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                <a class="btn btn-success" href="{{route('sampah.jadwal.restore',$data->id)}}">Pulihkan</a>
            </div>
        </div>
    </div>
</div>