<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Klinik Medicoal - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"
                                 style="background-image: url('{{ asset('img/logo.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('img/logo.png') }}" alt="Logo Klinik" style="width: 100px;">
                                        <h1 class="h4 text-gray-900 mt-2">Selamat Datang di Klinik Medicoal</h1>
                                    </div>
                                    <form class="user" method="POST" action="/login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                   name="email" placeholder="Enter Email Address..." required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                   name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                        @if($errors->any())
                                            <div class="alert alert-danger mt-2">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if(session('error'))
                                            <div class="alert alert-danger mt-2">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Lupa Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Buat Akun Baru!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
