    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ URL::asset('assets/admin') }}/vendor/libs/jquery/jquery.js"></script>
    
    <script src="{{ URL::asset('assets/admin') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ URL::asset('assets/admin') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ URL::asset('assets/admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ URL::asset('assets/admin') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ URL::asset('assets/admin') }}/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{ URL::asset('assets/admin') }}/js/ui-toasts.js"></script>

    @yield('js')
    <!-- Main JS -->
    <script src="{{ URL::asset('assets/admin') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ URL::asset('assets/admin') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
