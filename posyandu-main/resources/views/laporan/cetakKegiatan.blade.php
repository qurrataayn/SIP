<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        @page {
            size: A4 portrait;
            /* Mengatur ukuran halaman ke potret */
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body>
    <h1 style="text-align: center;">Laporan Data Kegiatan</h1>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>judul</th>
                <th>Posko</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <th scope="row">{{$no++}}</th>
                <th>{{$data->judul}}</th>
                <th>{{$data->getPosko->name}}</th>
                <th>{{$data->tanggal}}</th>
                <th>{{$data->start}}</th>
                <th>{{$data->finish}}</th>
                <th>
                    @if ($data->tanggal > $today)
                    <span class="badge bg-success">Belum Selesai</span>
                    @else
                    <span class="badge bg-danger">Selesai</span>
                    @endif
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>