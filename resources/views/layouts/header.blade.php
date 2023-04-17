<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ $config->favicon }}">
    <title>@yield('title')</title>

    {{-- font and icon --}}
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('backend') }}/assets/css/material-dashboard.minf700.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">


    @livewireStyles
    <style>
        ::-webkit-scrollbar {
  background-color: transparent; /* Kaydırma çubuklarının arka plan rengini şeffaf hale getirir */
  width: 12px; /* Kaydırma çubuklarının genişliği */
}

::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0); /* Kaydırma çubuğunun rengi (yarı şeffaf siyah) */
}
    </style>
</head>

<body class="dark-edition" id="dark-edition">
    @php
    use App\Http\Controllers\HashController;

    $hash = new HashController();
    @endphp
    <div class="wrapper ">

        <div class="sidebar" data-color="purple" data-background-color="default"
            data-image="{{ asset('backend') }}/assets/img/sidebar-1.jpg">

            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('index') }}" class="simple-text logo-normal" style="margin-left:25%; font-weight:bold;">
                    <img src="{{ asset($config->logo) }}"  width="150px" height="50px" alt="Site Logo">
                </a>
            </div>
            <div class="sidebar-wrapper">
                <!-- giriş yapan yetkili adı ve yetkisinin yazdığı kısım -->
                <div class="user">
                    <div class="user-info">
                        <a  href="{{route('managers.index')}}" class="username collapsed">
                            <span style="margin-left:30%; font-weight:bold;">
                                {{ Auth::user()->name }} -
                                @switch(Auth::user()->authority_status)
                                    @case(1)
                                        Yönetici
                                        @break
                                    @case(2)
                                        Admin
                                        @break
                                    @case(3)
                                        Moderatör
                                        @break
                                    @default
                                        Belirtilmemiş
                                @endswitch
                            </span>
                        </a>
                    </div>
                </div>
                <!-- Menu -->
                <ul class="nav">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }} ">
                        <a class="nav-link" href="{{ route('index') }}">
                            <i class="material-icons">home</i>
                            <p>Anasayfa</p>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('gamer-process*', 'gamer-data*', 'user-nick-exceptional*')) ? 'active' : '' }}">
                        <a class="nav-link " data-toggle="collapse" href="#pagesExamples">
                            <i class="material-icons">manage_accounts</i>
                            <p> Kullanıcı İşlemleri
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="pagesExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('gamer-process.index') }}">
                                        <span class="sidebar-mini"> Oİ</span>
                                        <span class="sidebar-normal"> Oyuncu İşlemleri </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('gamer-data.index') }}">
                                        <span class="sidebar-mini"> OB </span>
                                        <span class="sidebar-normal"> Oyuncu Bilgileri </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('user-nick-exceptional.index') }}">
                                        <span class="sidebar-mini"> N </span>
                                        <span class="sidebar-normal"> Nick Değiştirme İstisnaları </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ (request()->is('gamer-ban*', 'gamer-ban-list*')) ? 'active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                            <i class="material-icons">person_off</i>
                            <p> Kullanıcı Ban İşlemleri
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="componentsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('gamer-ban.index') }}">
                                        <span class="sidebar-mini"> OB </span>
                                        <span class="sidebar-normal"> Oyuncu Banla </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('gamer-ban-list.index') }}">
                                        <span class="sidebar-mini"> OBL </span>
                                        <span class="sidebar-normal"> Oyuncu Ban Listesi </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if (Auth::user()->authority_status == 1 )
                    <li class="nav-item {{ (request()->is('game-settings*', 'site-settings*', 'log-recording*')) ? 'active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                            <i class="material-icons">tune</i>
                            <p> Sistem
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('game-settings.index') }}">
                                        <span class="sidebar-mini"> OA </span>
                                        <span class="sidebar-normal"> Oyun Ayarları <span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('site-settings.index') }}">
                                        <span class="sidebar-mini"> SA </span>
                                        <span class="sidebar-normal"> Site Ayarları </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('log-recording.index') }}">
                                        <span class="sidebar-mini"> LK </span>
                                        <span class="sidebar-normal"> Log Kayıtları </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @elseif(Auth::user()->authority_status == 2)
                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                            <i class="material-icons">tune</i>
                            <p> Sistem
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('game-settings.index') }}">
                                        <span class="sidebar-mini"> OA </span>
                                        <span class="sidebar-normal"> Oyun Ayarları <span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('site-settings.index') }}">
                                        <span class="sidebar-mini"> SA </span>
                                        <span class="sidebar-normal"> Site Ayarları </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('log-recording.index') }}">
                                        <span class="sidebar-mini"> LK </span>
                                        <span class="sidebar-normal"> Log Kayıtları </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if (Auth::user()->authority_status == 1)
                    <li class="nav-item {{ (request()->is('managers*')) ? 'active' : '' }} ">
                        <a class="nav-link " href="{{ route('managers.index') }}">
                            <i class="material-icons">admin_panel_settings</i>
                            <p> Yetkililer</p>
                        </a>
                    </li>

                    @endif
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('login.logout') }}">
                            <i class="material-icons">logout</i>
                            <p> Çıkış</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">

            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:;">@yield('admin-title')</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                </div>
            </nav>
