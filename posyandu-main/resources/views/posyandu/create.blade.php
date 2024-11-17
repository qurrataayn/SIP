<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Posko Posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('posyandu.createOrUpdate')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Keluarga </label>
                        <select class="form-control" name="keluarga_id" id="keluarga">
                            <option value="">Pilih Keluarga</option>
                            @foreach ($keluarga as $keluarga)
                            <option value="{{$keluarga->id}}">{{$keluarga->nama_keluarga}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Anggota Keluarga </label>
                        <select class="form-select form-select-lg" name="anggota_id" id="anggota">
                            <option selected>---Pilih Anggota Keluarga---</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Tanggal Lahir </label>
                        <input type="date" name="tanggal_lahir" id="datepicker" class="form-control" placeholder="Tanggal Lahir">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Tinggi Badan (CM)</label>
                        <input type="number" name="tinggi_badan" class="form-control" placeholder="Tinggi Badan" step="any">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Berat Badan (KG)</label>
                        <input type="number" name="berat_badan" class="form-control" placeholder="Berat Badan" step="any">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Lingkar Lengan (CM)</label>
                        <input type="number" name="lingkar_lengan" class="form-control" step="any" placeholder="Lingkar Lengan">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Lingkar Kepala (CM)</label>
                        <input type="number" name="lingkar_kepala" step="any" class="form-control" placeholder="Lingkar Kepala">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Tekanan Darah (MMHG)</label>
                        <input type="text" name="tekanan_darah" class="form-control" placeholder="Tekanan Darah">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Umur </label>
                        <input type="text" name="umur" class="form-control" id="umur" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Imunisasi </label>
                        <div class="form-check d-flex justify-content-evenly">
                            <div class="col-md-5">
                                <input type="radio" id="imunisasi1" class="form-check-input" name="imunisasi" value="Iyes">
                                <label for="imunisasi1">Iya</label><br>
                            </div>
                            <div class="col-md-5">
                                <input type="radio" id="imunisasi2" class="form-check-input" name="imunisasi" value="no">
                                <label for="imunisasi2">Tidak</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="imunisasiDetail" style="display:none;">
                        <label for="imunisasi"> Keterangan Imunisasi</label>
                        <input type="text" id="imunisasi" name="imunisasi" placeholder="keterangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Vitamin </label>
                        <div class="form-check d-flex justify-content-evenly">
                            <div class="col-md-5">
                                <input type="radio" id="vitamin1" class="form-check-input" name="vitamin" value="Vyes">
                                <label for="vitamin1">Iya</label><br>
                            </div>
                            <div class="col-md-5">
                                <input type="radio" id="vitamin2" class="form-check-input" name="vitamin" value="no">
                                <label for="vitamin2">Tidak</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="vitaminDetail" style="display:none;">
                        <label for="vitamin"> Keterangan Vitamin</label>
                        <input type="text" id="vitamin" name="vitamin" placeholder="keterangan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Obat Tambah Darah </label>
                        <div class="form-check d-flex justify-content-evenly">
                            <div class="col-md-5">
                                <input type="radio" id="obatDarah1" class="form-check-input" name="obatDarah" value="Oyes">
                                <label for="obatDarah1">Iya</label><br>
                            </div>
                            <div class="col-md-5">
                                <input type="radio" id="obatDarah2" class="form-check-input" name="obatDarah" value="no">
                                <label for="obatDarah2">Tidak</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="obatDarahDetail" style="display:none;">
                        <label for="obatDarah"> Keterangan Obat Tambah Darah</label>
                        <input type="text" id="obatDarah" placeholder="keterangan" name="obat_tambah_darah" class="form-control">
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