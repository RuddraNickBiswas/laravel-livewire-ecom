@props(['title' => 'default', 'breadcrumbs'])
<div id="kt_app_toolbar"
    class="app-toolbar pt-6 pb-2">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container"
        class="app-container container-fluid d-flex align-items-stretch">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Overview</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <!--begin::Item-->
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item text-muted">
                            <a wire:navigate href="{{ route($breadcrumb['route']) }}"
                                class="text-muted text-hover-primary">{{ $breadcrumb['name'] }}</a>
                        </li>

                        @if (!$loop->last)
                            <!-- Check if it's not the last item -->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                        @endif
                    @endforeach
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            {{ $slot }}
            <!--end::Actions-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
