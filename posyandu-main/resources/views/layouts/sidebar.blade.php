<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <div class="col-md-12">
                        <h1 class="text-center">SIP</h1>
                    </div>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="{{route('home')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Layouts -->
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Data Master</div>
                        </a>

                        <ul class="menu-sub">
                            @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
                            <li class="menu-item">
                                <a href="{{route('user')}}" class="menu-link">
                                    <div data-i18n="Without menu">Akun</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{route('keluarga')}}" class="menu-link">
                                    <div data-i18n="Without menu">Keluarga</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 1)
                            <li class="menu-item">
                                <a href="{{route('posko')}}" class="menu-link">
                                    <div data-i18n="Without menu">Posko Posyandu</div>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 3)
                            <li class="menu-item">
                                <a href="{{route('kategori')}}" class="menu-link">
                                    <div data-i18n="Without menu">Kategori Artikel</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('artikel')}}" class="menu-link">
                                    <div data-i18n="Without menu">Artikel</div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    <li class="menu-item">

                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Layouts">Posyandu</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{route('jadwal')}}" class="menu-link">
                                    <div data-i18n="Without menu">Jadwal Posyandu</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('posyandu')}}" class="menu-link">
                                    <div data-i18n="Without menu">Data Posyandu</div>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- Layouts -->
                    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Laporan</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{route('laporan.kegiatan')}}" class="menu-link">
                                    <div data-i18n="Without menu">Laporan Kegiatan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('laporan.posyandu')}}" class="menu-link">
                                    <div data-i18n="Without menu">Laporan Data Posyandu</div>
                                </a>
                            </li>

                        </ul>
                    </li>

                    @endif

                    @if(Auth::user()->role_id == 1 )

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div data-i18n="Layouts">Sampah</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{route('sampah.posko')}}" class="menu-link">
                                    <div data-i18n="Without menu">Posko</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('sampah.jadwal')}}" class="menu-link">
                                    <div data-i18n="Without menu">Jadwal Posyandu</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('sampah.posyandu')}}" class="menu-link">
                                    <div data-i18n="Without menu">Data Posyandu</div>
                                </a>
                            </li>

                        </ul>
                    </li>

                    @endif
                </ul>
            </aside>
            <!-- / Menu -->