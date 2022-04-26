<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="edward evbert">
    <link rel="icon" type="image/png" href="/assets/app/images/logo/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GA | Login</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/template/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-login-image {
            background: url("/assets/template/img/undraw_designer_re_5v95.svg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 400px;
            height: 400px;
        }

        .card {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 85%;
            transform: translate(-50%, -50%)
        }


        .bg-login {
            background: #4DA0B0;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #FF2E63, #222831);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #FF2E63, #222831);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

    </style>
</head>

<body class="">
    <div class="container">

        <!-- Outer Row -->
        <div class="card border-0 shadow">
            <div class="card-body">
                <h3 class="text-center font-weight-bolder">General Affair</h3>

                <div class="row justify-content-center align-items-center">
                    <!-- Nested Row within Card Body -->
                    <div class="col-lg-6 d-none d-lg-block bg-login-image">
                    </div>

                    <div class="col-md-6">
                        <div class="p-5">
                            <div class="text-center">
                                <img class="rounded" width="auto" height="75"
                                    src="/assets/app/images/logo/logo.png" alt="">
                                <h1 class="h4 text-dark mb-4"> <i class="fa fa-user"></i> Login Page</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username"
                                        class="form-control form-control-user @error('username') is-invalid @enderror"
                                        id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username"
                                        value="{{ old('username') }}" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback text-xs" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-user  @error('password') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="Password"
                                        autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback text-xs" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div> --}}
                                <button type="submit" class="btn btn-outline-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            {{-- <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/template/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/template/js/sb-admin-2.min.js"></script>

</body>

</html>
