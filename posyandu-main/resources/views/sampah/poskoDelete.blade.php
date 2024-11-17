<div class="modal fade" id="exampleModalDelete{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-wrap">

                <h6>

                    Apakah anda yakin ingin menghapus data posko posyandu dengan nama {{$data->name}} ?
                </h6>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <a class="btn btn-danger" href="{{route('sampah.posko.delete',$data->id)}}">Hapus</a>
            </div>
        </div>
    </div>
</div>