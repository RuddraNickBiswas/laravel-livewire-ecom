<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    {{--{{ asset('fn/') }}--}}
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="SemiColonWeb">
    <meta name="description" content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">

    <!-- Core Style -->
    <link rel="stylesheet" href="{{ asset('fn/style.css') }}">

    <!-- Font Icons -->
    <link rel="stylesheet" href="{{ asset('fn/css/font-icons.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('fn/css/custom.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title
    ============================================= -->
    <title> {{ $title ?? "aEcom" }} </title>
    @vite(['resources/js/app.js'])
    @stack('styles')
    @livewireStyles
</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper">

    <!-- Header
    ============================================= -->
    <x-fn.layouts.header />
    <!-- #header end -->
    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap">
          {{ $slot }}
        </div>
    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <x-fn.layouts.footer />
  <!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="uil uil-angle-up"></div>

<!-- JavaScripts
============================================= -->
{{--<script src="{{ asset('fn/js/plugins.min.js') }}" data-navigate-once></script>--}}
<script src="{{ asset('fn/js/functions.bundle.js') }}" data-navigate-once></script>

@stack('scripts')
@livewireScripts
</body>
</html>
