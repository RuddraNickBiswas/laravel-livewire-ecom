<!--begin::App-->
<div class="d-flex flex-column flex-root app-root"
    id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid "
        id="kt_app_page">
        <x-admin.layout.partials.header />
        <!--layout-partial:layout/partials/_header.html-->
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid "
            id="kt_app_wrapper">

            <x-admin.layout.partials.sidebar />
            <!--layout-partial:layout/partials/_sidebar.html-->
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid "
                id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">

                    <x-admin.layout.partials.content />

                    <!--layout-partial:layout/partials/_content.html-->
                </div>
                <!--end::Content wrapper-->
                <x-admin.layout.partials.footer />
                <!--layout-partial:layout/partials/_footer.html-->
            </div>
            <!--end:::Main-->

            <x-admin.layout.partials.aside />
            <!--layout-partial:layout/partials/_aside.html-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<x-admin.partials.drawers/>
<!--layout-partial:partials/_drawers.html-->
