<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        @page {
            size: A4 lancape;
            /* Mengatur ukuran halaman ke potret */
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body>
    <h1 style="text-align: center;">Laporan Data Posyandu</h1>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Keluarga</th>
                <th>Anggota</th>
                <th>Posko</th>
                <th>Tanggal Lahir </th>
                <th>Umur</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Lingkar Lengan </th>
                <th>Lingkar Kepala </th>
                <th>Tekanan Darah</th>
                <th>Imunisasi</th>
                <th>Vitamin </th>
                <th>Obat Tambah Darah</th>

            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <th scope="row">{{$no++}}</th>
                <th>{{$data->getAnggota ? $data->getAnggota->getKeluarga->nama_keluarga : ''}}</th>
                <th>{{$data->getAnggota ? $data->getAnggota->nama_anggota : ''}}</th>
                <th>{{$data->getPosko ? $data->getPosko->name : ''}}</th>
                <th>{{$data->tanggal_lahir}}</th>
                <th>{{$data->umur}} Tahun</th>
                <th>{{$data->tinggi_badan}} cm</th>
                <th>{{$data->berat_badan}} Kg</th>
                <th>{{$data->lingkar_lengan}} cm</th>
                <th>{{$data->lingkar_kepala}} cm</th>
                <th>{{$data->tekanan_darah}}</th>
                <th>{{$data->imunisasi}}</th>
                <th>{{$data->vitamin}}</th>
                <th>{{$data->obat_tambah_darah}}</th>


            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>