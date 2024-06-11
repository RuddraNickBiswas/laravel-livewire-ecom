<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>{{ $title ?? 'RNB' }}</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="
         meta description
        " />
    <meta name="keywords"content="meta keywords " />
    <meta name="viewport"
        content="width=device-width, initial-scale=1" />
    <meta property="og:locale"
        content="en_US" />
    <link rel="shortcut icon"
        href="{{ asset('admin/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
        rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.css') }}"
        rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}"
        rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}"
        rel="stylesheet"
        type="text/css" />





    @vite(['resources/js/app.js'])
    <!-- Styles -->
    @stack('styles')

    @livewireStyles
    <!--end::Global Stylesheets Bundle-->
    <script data-navigate-track>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body"
    data-kt-app-header-fixed="true"
    data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true"
    data-kt-app-aside-enabled="true"
    data-kt-app-aside-fixed="true"
    data-kt-app-aside-push-toolbar="true"
    data-kt-app-aside-push-footer="true"
    class="app-default">
    <x-admin.partials.theme-mode.init />


    <!--CONTENT -->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root"
        id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid "
            id="kt_app_page">
            <x-admin.layout.partials.header />

            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid "
                id="kt_app_wrapper">

                <x-admin.layout.partials.sidebar />

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid "
                    id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!-- to get perfect design page should incloude those -->
                        {{-- <x-admin.layout.partials.toolbar >

                        </x-admin.layout.partials.toolbar>
                        <x-admin.layout.partials.content >

                        </x-admin.layout.partials.content> --}}

                        {{ $slot }}

                    </div>
                    <!--end::Content wrapper-->
                    <x-admin.layout.partials.footer />

                </div>
                <!--end:::Main-->

                <x-admin.layout.partials.aside />

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <x-admin.partials.drawers />


    <!--ENDCONTENT -->


    <x-admin.partials.scrolltop />
    <!--layout-partial:partials/_scrolltop.html-->
    <!--begin::Modals-->




    {{-- <x-admin.partials.modals.upgrade-plan />
    <x-admin.partials.modals.view-users />
    <x-admin.partials.modals.users-search.main />
    <x-admin.partials.modals.invite-friends /> --}}


    <!--end::Modals-->
    <!--begin::Javascript-->
    <script data-navigate-track>
        var hostUrl = "{{ asset('admin/assets/') }}/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"
        data-navigate-once></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"
        data-navigate-once></script>
    <!--end::Global Javascript Bundle-->



    {{-- <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('admin/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript--> --}}

    <!--end::Javascript-->



    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', (message) => {
                toastr.success(message);
            });
            Livewire.on('error', (message) => {
                toastr.error(message);
            });

            Livewire.on('swal', (message, icon, confirmButtonText) => {
                if (typeof icon === 'undefined') {
                    icon = 'success';
                }
                if (typeof confirmButtonText === 'undefined') {
                    confirmButtonText = 'Ok, got it!';
                }
                Swal.fire({
                    text: message,
                    icon: icon,
                    buttonsStyling: false,
                    confirmButtonText: confirmButtonText,
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                });
            });
        });
    </script>

    @stack('scripts')
    @livewireScripts
</body>
<!--end::Body-->

</html>
