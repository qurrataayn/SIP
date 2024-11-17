<div class="modal fade" id="exampleModaledit{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('user.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf

                    <input name="id" value="{{$data->id}}" hidden>
                    <div class="mb-3">
                        <label for="username" class="col-form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username" value="{{$data->username}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="" placeholder="email" value="{{$data->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Role</label>
                        <select name="role_id" id="" class="form-control">

                            @foreach ($role as $role)
                            <option value="{{$role->id}}" {{ $role->id == $data->role_id ? 'selected' : '' }}>{{$role->name}}</option>
                            @endforeach
                        </select>
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