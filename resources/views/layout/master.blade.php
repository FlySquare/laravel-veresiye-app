
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Panel | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img style="width: 40px" src="{{ \App\Helpers\GeneralHelper::getCurrentLanguage()['flag'] }}"
                         alt="">
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('index') }}" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ \App\Helpers\GeneralHelper::getLogged()->name }}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @foreach(\App\Helpers\GeneralHelper::getMenu() as $menu)
                        @if(!isset($menu['guard']) || isset($menu['guard']) && in_array(\App\Helpers\GeneralHelper::getLogged()->role, $menu['guard']))
                            <li class="nav-item {{ $menu['badgeClass'] }} @if(count($menu['subMenus']) > 0) @foreach($menu['subMenus'] as $subMenu) @if(request()->routeIs($subMenu['route'])) menu-open @endif @endforeach @endif">
                                <a href="{{ count($menu['subMenus'])  > 0? '#' : $menu['link'] }}"
                                   class="nav-link @if(count($menu['subMenus']) > 0) @foreach($menu['subMenus'] as $subMenu) @if(request()->routeIs($subMenu['route'])) active @endif @endforeach @endif @if(request()->routeIs($menu['route'])) active @endif">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <p>
                                        {{ $menu['title'] }}
                                        @if(count($menu['subMenus']) > 0)
                                            <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>
                                @if(count($menu['subMenus']) > 0)
                                    <ul class="nav nav-treeview">
                                        @foreach($menu['subMenus'] as $subMenu)
                                            @if(!isset($subMenu['guard']) || isset($subMenu['guard']) && in_array(\App\Helpers\GeneralHelper::getLogged()->role, $subMenu['guard']))
                                                <li class="nav-item">
                                                    <a href="{{ $subMenu['link'] }}"
                                                       class="nav-link @if(request()->routeIs($subMenu['route'])) active @endif">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>{{ $subMenu['title'] }}</p>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @hasSection('content_header')
            @yield('content_header')
        @else
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right"></ol>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="https://consulting-trust.de/">Consulting Trust</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Developer: <a href="https://iamumut.com">Umut Can Arda</a> | Version</b> 1.0.3
        </div>
    </footer>
</div>

@if (session()->has('alert'))
    <script>
        swal(
            "{{ session('alert.title') }}",
            "{{ session('alert.text') }}",
            "{{ session('alert.type') }}"
        );
    </script>
@endif
@if ($errors->any())
    <script>
        swal("Error!", "{{ $errors->first() }}", "error");
    </script>
@endif

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/flysquare.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
@stack('js')
</body>
</html>
