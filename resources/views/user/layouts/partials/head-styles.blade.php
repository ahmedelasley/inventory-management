
<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/user') }}/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
rel="stylesheet"
/>

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/vendor/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<link rel="stylesheet" href="{{ URL::asset('assets/user') }}/vendor/libs/apex-charts/apex-charts.css" />

<!-- Page CSS -->
@yield('css')
<!-- Helpers -->
<script src="{{ URL::asset('assets/user') }}/vendor/js/helpers.js"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ URL::asset('assets/user') }}/js/config.js"></script>
