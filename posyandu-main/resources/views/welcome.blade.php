<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="antialiased" style="background-color:#9f98e0;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="#">
                <h4>
                    <b>SIP</b>
                </h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('login')}}">
                            <h4><b>Login</b></h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row d-flex justify-content-center px-2">
            <h3 class="text-center"><b>Informasi Kesehatan</b></h3>
            <hr>
            <div class="row">
                <form method="post" action="{{route('pencarian')}}">
                    @csrf
                    <div class="col-md-12 d-flex justify-content-center align-content-end">
                        <div class="col-md-3 mx-3">
                            <label for="" class="text-light">Kategori</label>
                            <select name="kategori" id="" class="form-control" required>
                                @foreach ($kategori as $data)
                                <option value="{{$data->id}}">{{$data->nama}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mx-3">
                            <label for="" class="text-light">Judul</label>
                            <input type="text" class="form-control" name="judul" id="" placeholder="Judul" required>
                        </div>
                        <div class="col-md-1 mx-3  align-content-end">
                            <button type="submit" class="btn btn-primary"> Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            @foreach ($artikel as $data)


            <div class="card px-0 col-md-3 m-3 ">
                <img src="{{asset('image/artikel/'.$data->images)}}" class="card-img-top" alt="...">
                <a class="text-dark" href="{{route('detailArtikel',$data->slug)}}">
                    <div class="card-body">
                        <h4 class="text-center"><b>{{$data->judul}}</b></h4>
                        <p>

                            {!! Str::limit($data->deskripsi,120) !!}
                        </p>
                    </div>
                </a>
            </div>



            @endforeach

            @if($jumlah === 0)
            <div class="card px-0 col-md-10 m-3 ">
                <H2>Data Tidak ditemukan</H2>
            </div>

            @endif
        </div>
</body>

</html>