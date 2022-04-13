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

    <title>@yield('title', 'ATL | GA')</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="/assets/template/css/sb-admin-2.css" rel="stylesheet">
    <link href="/assets/app/css/styles.css" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.components.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.header')
                @yield('container')
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. Atap Teduh Lestari . {{ now()->format('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Sign Out" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form class="my-2" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger btn-block" type="submit"><i
                                class="fas fa-sign-out-alt"></i> Yes, let me out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.components.script')
</body>

</html>
