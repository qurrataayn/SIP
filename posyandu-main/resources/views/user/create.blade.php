<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('user.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="col-form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="" placeholder="email">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Role</label>
                        <select name="role_id" id="role" class="form-control" onchange="showAdditionalFields()">
                            <option value="" disabled selected>Pilih Role Akun</option>
                            @foreach ($role as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="additionalFields" style="display: none;">
                        <label for="keluarga">Keluarga:</label>
                        <select name="keluarga_id" class="form-control">
                            <option value="" disabled selected>Pilih keluarga</option>
                            @foreach ($keluarga as $keluarga)
                            <option value="{{$keluarga->id}}">{{$keluarga->nama_keluarga}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="additionalFieldsPosko" style="display: none;">
                        <label for="keluarga">Posko:</label>
                        <select name="posko_id" class="form-control">
                            <option value="" disabled selected>Pilih Posko Posnyandu</option>
                            @foreach ($posko as $posko)
                            <option value="{{$posko->id}}">{{$posko->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>