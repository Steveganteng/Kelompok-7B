<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Klinik Medicoal - Login</title>

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <style>
        /* Background gradasi very soft abu */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(180deg, #fff 0%, #f5f7fa 100%);
            color: #343A40;
        }

        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        /* Card dengan border biru lembut dan shadow halus */
        .card {
            max-width: 440px;
            width: 100%;
            border-radius: 16px;
            border: 1.8px solid #c7d0e0; /* biru sangat lembut */
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(26, 54, 93, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 30px rgba(26, 54, 93, 0.15);
        }

        .card-body {
            padding: 3rem 3rem;
        }

        .logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .logo-wrapper img {
            width: 100px;
            user-select: none;
        }

        h1 {
            font-weight: 700;
            color: #1A365D;
            font-size: 1.8rem;
            letter-spacing: 0.02em;
            margin-bottom: 2rem;
            text-align: center;
        }

        /* Input dengan border bawah dan efek fokus */
        .form-control-user {
            border: none;
            border-bottom: 2px solid #E9ECEF;
            border-radius: 0;
            padding: 10px 12px;
            font-size: 1rem;
            background-color: transparent;
            color: #343A40;
            box-shadow: none !important;
            transition: border-color 0.3s ease;
        }

        .form-control-user::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control-user:focus {
            border-bottom-color: #1A365D;
            outline: none;
            box-shadow: none !important;
            background-color: transparent;
        }

        /* Button dengan gradien lembut */
        .btn-primary.btn-user.btn-block {
            background: linear-gradient(90deg, #1A365D 0%, #3b5998 100%);
            border: none;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 14px 0;
            border-radius: 10px;
            letter-spacing: 0.04em;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 12px rgba(26, 54, 93, 0.3);
            color: #fff;
            user-select: none;
        }

        .btn-primary.btn-user.btn-block:hover,
        .btn-primary.btn-user.btn-block:focus {
            background: linear-gradient(90deg, #3b5998 0%, #1A365D 100%);
            box-shadow: 0 8px 18px rgba(26, 54, 93, 0.5);
            color: #fff;
        }

        /* Checkbox label */
        .custom-control-label {
            font-weight: 600;
            color: #1A365D;
            user-select: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .custom-control-label:hover {
            color: #16325C;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #1A365D;
            border-color: #1A365D;
            box-shadow: none !important;
        }

        /* Alert */
        .alert-danger {
            border-radius: 10px;
            border: 1.5px solid #DC3545;
            background-color: #F8D7DA;
            color: #842029;
            font-weight: 600;
            box-shadow: none !important;
            margin-top: 1.5rem;
        }

        /* Links */
        .text-center a.small {
            color: #1A365D;
            font-weight: 600;
            transition: color 0.3s ease;
            text-decoration: none;
            user-select: none;
        }

        .text-center a.small:hover {
            color: #16325C;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 2rem 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card o-hidden border-0">
            <div class="card-body">
                <div class="logo-wrapper">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Klinik" />
                </div>
                <h1>Selamat Datang di Klinik Medicoal</h1>

                <form class="user" method="POST" action="/login" autocomplete="off" novalidate>
                    @csrf
                    <div class="form-group mb-4">
                        <input type="email" class="form-control form-control-user" name="email" placeholder="Masukkan Email" required autofocus />
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required />
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" />
                            <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>

                <hr />

                <div class="text-center mt-3">
                    <a class="small" href="#">Lupa Password?</a>
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
