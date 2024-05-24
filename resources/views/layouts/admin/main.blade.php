<!doctype html>

<html 
lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin/assets/') }}/" 
  data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title ?? 'Page Title' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />



    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-advance.css') }}" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Scripts -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}" data-navigate-track></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
     {{-- <script src="{{ asset('admin/assets/vendor/js/template-customizer.js') }}" data-navigate-once></script>  --}}

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    {{-- PROBLEM     --}}
    <script src="{{ asset('admin/assets/js/config.js') }}" data-navigate-track></script>




    <!-- Styles -->
    @stack('styles')
    @livewireStyles
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @persist('menu')
            <x-admin.layouts.menu.menu-vertical />
            @endpersist

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @persist('nav')
                <x-admin.layouts.navbar.nav-vertical />
                @endpersist
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @persist('footer')
                   <x-admin.layouts.footer />
                    @endpersist
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->





    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('admin/assets/vendor/libs/hammer/hammer.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/i18n/i18n.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}" data-navigate-once></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/swiper/swiper.js') }}" data-navigate-once></script>
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}" data-navigate-once>
    </script>

    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>



    @livewireScripts
    @stack('scripts')
</body>

</html>
