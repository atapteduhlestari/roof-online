<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GA | Login</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/template/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/assets/app/css/styles.css" rel="stylesheet">
    <style>
        .bg-login {
            background: #0f0c29;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

    </style>
</head>

<body class="bg-login">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-4 pt-5">
                <div class="card border-0 shadow my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
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
