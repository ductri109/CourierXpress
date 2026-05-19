<!doctype html>
<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="vertical-menu-template-starter"
    data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Admin') | CourierXpress</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <script src="/assets/js/config.js"></script>
    @stack('styles')
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- ===== SIDEBAR MENU ===== -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo demo me-1">
                <span style="color: var(--bs-primary)">
                  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="currentColor"/>
                  </svg>
                </span>
              </span>
                    <span class="app-brand-text demo menu-text fw-semibold ms-2">CourierXpress</span>
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="menu-toggle-icon d-xl-block align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">

                <!-- Dashboard -->
                <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-home-2-line"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                <!-- Quản lý vận đơn -->
                <li class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-file-list-3-line"></i>
                        <div>Quản lý vận đơn</div>
                    </a>
                </li>

                <!-- Customer Details -->
                <li class="menu-item {{ request()->routeIs('admin.customers.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ri-user-3-line"></i>
                        <div>Customer Details</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.customers.overview') ? 'active' : '' }}">
                            <a href="{{ route('admin.customers.overview', 1) }}" class="menu-link"><div>Overview</div></a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.customers.security') ? 'active' : '' }}">
                            <a href="{{ route('admin.customers.security', 1) }}" class="menu-link"><div>Security</div></a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.customers.billing') ? 'active' : '' }}">
                            <a href="{{ route('admin.customers.billing', 1) }}" class="menu-link"><div>Address & Billing</div></a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.customers.notifications') ? 'active' : '' }}">
                            <a href="{{ route('admin.customers.notifications', 1) }}" class="menu-link"><div>Notifications</div></a>
                        </li>
                    </ul>
                </li>

                <!-- ❌ Fleet đã xóa -->

                <!-- Quản lý Agent (MỚI) -->
                <li class="menu-item {{ request()->routeIs('admin.agents.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.agents.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-shield-user-line"></i>
                        <div>Quản lý Agent</div>
                    </a>
                </li>

                <!-- Quản lý nhân viên -->
                <li class="menu-item {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-team-line"></i>
                        <div>Quản lý nhân viên</div>
                    </a>
                </li>

                <!-- User Account (admin profile) -->
                <li class="menu-item {{ request()->routeIs('admin.account') ? 'active' : '' }}">
                    <a href="{{ route('admin.account') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-account-circle-line"></i>
                        <div>User Account</div>
                    </a>
                </li>

            </ul>
        </aside>
        <!-- /Menu -->

        <!-- Layout page -->
        <div class="layout-page">

            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                        <i class="ri-menu-fill ri-24px"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                            <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <i class="ri-24px"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                                <li><a class="dropdown-item" href="javascript:void(0);" data-theme="light"><span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span></a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-theme="dark"><span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span></a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-theme="system"><span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span></a></li>
                            </ul>
                        </div>
                    </div>

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                <li>
                                    <a class="dropdown-item pb-3" href="{{ route('admin.account') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_name }}</h6>
                                                <small class="text-muted">Quản trị viên</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><div class="dropdown-divider my-1"></div></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.account') }}">
                                        <i class="ri-user-3-line me-2"></i>
                                        <span class="align-middle">Hồ sơ của tôi</span>
                                    </a>
                                </li>
                                <li><div class="dropdown-divider my-1"></div></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                       onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                        <i class="ri-shut-down-line me-2"></i>
                                        <span class="align-middle">Đăng xuất</span>
                                    </a>
                                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                @yield('content')

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                            <div class="text-body mb-2 mb-md-0">
                                © <script>document.write(new Date().getFullYear());</script>,
                                made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by
                                <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
                            </div>
                            <div class="d-none d-lg-inline-block">
                                <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- /Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- /Content wrapper -->
        </div>
        <!-- /Layout page -->
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
<!-- /Layout wrapper -->

<!-- Core JS -->
<script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/assets/vendor/js/menu.js"></script>
<script src="/assets/js/main.js"></script>
@stack('scripts')
</body>
</html>
