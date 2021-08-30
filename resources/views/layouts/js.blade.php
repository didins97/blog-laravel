    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    @stack('page-script');

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @stack('after-script');

    </body>

    </html>
