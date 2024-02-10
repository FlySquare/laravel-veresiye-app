<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş | {{ env('app_name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/general.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <p class="login-box-msg">Hesabınızla Giriş Yapın</p>

            <form action="{{ route('auth.post-login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input required type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input required type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
        swal("Hata!", "{{ $errors->first() }}", "error");
    </script>
@endif



<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
