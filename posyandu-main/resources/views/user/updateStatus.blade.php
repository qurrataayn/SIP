<div class="modal fade" id="exampleModalStatus{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-wrap">

                <h6>

                    Apakah anda yakin ingin mengubah status dengan username akun {{$data->username}} ?
                </h6>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($data->is_active == 0)
                <a class="btn btn-success" href="{{route('user.updateStatus',$data->id)}}">Aktif</a>
                @else
                <a class="btn btn-danger" href="{{route('user.updateStatus',$data->id)}}">Nonaktif</a>
                @endif
            </div>
        </div>
    </div>
</div>