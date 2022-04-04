<!-- Bootstrap core JavaScript-->
<script src="/assets/template/vendor/jquery/jquery.min.js"></script>
<script src="/assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/assets/template/js/sb-admin-2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

{{-- <script>
    $('.input-group.date').datepicker({
        format: "dd.mm.yyyy"
    });
</script> --}}

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: `<?= session('success') ?>`,
            timer: 1500,
            showConfirmButton: false,
            timerProgressBar: true,
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops!',
            text: `<?= session('warning') ?>`,
            timer: 1500,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: (swal) => {
                swal.addEventListener('mouseenter', Swal.stopTimer)
                swal.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Something wrong!',
            text: `Please check your input`,
            timer: 1500,
            showConfirmButton: false,
            timerProgressBar: true,
        });
    </script>
@endif
