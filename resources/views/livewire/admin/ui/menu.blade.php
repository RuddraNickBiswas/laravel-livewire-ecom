<aside id="layout-menu"
    class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html"
            class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32"
                    height="22"
                    viewBox="0 0 32 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                    <path opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                    <path fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>

        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>


    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item"> <!-- removed active open -->
            <a href="javascript:void(0);"
                class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="{{ $name }}">{{ $name }}</div>
                <div class="badge bg-primary rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="index.html"
                        class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a wire:navigate href="{{ route('admin.test') }}"
                        class="menu-link">
                        <div data-i18n="CRM">CRM</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html"
                        class="menu-link">
                        <div data-i18n="eCommerce">eCommerce</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Logistics">Logistics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-academy-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Academy">Academy</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text"
                data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>

        <!-- Manage Category -->
        <li class="menu-item">
            <a href="javascript:void(0);"
                class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="Manage Category">Manage Category</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Category Group">Category Group</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Category">Category</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Sub Category">Sub Category</div>
                    </a>
                </li>
            </ul>
        </li>
        <!--End Manage Category -->

        <!-- e-commerce-app menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);"
                class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="eCommerce">eCommerce</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html"
                        class="menu-link">
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- e-commerce-app menu end -->






        <!-- Charts & Maps -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text"
                data-i18n="Charts & Maps">Charts &amp; Maps</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);"
                class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                <div data-i18n="Charts">Charts</div>
            </a>
            <ul class="menu-sub active open">
                <li class="menu-item">
                    <a href="charts-apex.html"
                        class="menu-link">
                        <div data-i18n="Apex Charts">Apex Charts</div>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="charts-chartjs.html"
                        class="menu-link">
                        <div data-i18n="ChartJS">ChartJS</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a wire:template
                href="/admin/test"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-map"></i>
                <div data-i18n="Leaflet Maps">Leaflet Maps</div>
            </a>
        </li>

        <!-- Misc -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text"
                data-i18n="Misc">Misc</span>
        </li>
        <li  class="menu-item  {{ $name === 'test' ? 'active' : '' }}">
            <a wire:navigate
                href="{{ route('admin.test') }}"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Test">Test</div>
            </a>
        </li>

        <li class="menu-item {{ $name === 'dashboard' ? 'active' : '' }}">
            <a wire:navigate
                href="{{ route('admin.dashboard') }}"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-description"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>
</aside>
@script
<script>
    $wire.on('routeChanged', () => {
      console.log('hi')
    });
</script>
@endscript
