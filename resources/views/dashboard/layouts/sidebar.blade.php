<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index-2.html" class="text-nowrap logo-img">
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                    class="dark-logo" width="180" alt="" />
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg"
                    class="light-logo" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @role('admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                            href="{{ route('products.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-package"></i>
                            </span>
                            <span class="hide-menu">Product</span>
                        </a>
                    </li>
                @endrole

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow " href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-wallet"></i>
                        </span>
                        <span class="hide-menu">Saldo</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @role('admin')
                            <li class="sidebar-item">
                                <a href="{{ route('dashboard.topup.digiflazz') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Top Up Saldo Digiflazz</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('packages.whatsapp') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Saldo Agen</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('dashboard.history.digiflazz') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Riwayat Saldo Digiflazz</span>
                                </a>
                            </li>
                        @endrole
                        @role('agen')
                            <li class="sidebar-item">
                                <a href="{{ route('packages.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Top Up Saldo</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Riwayat Saldo</span>
                                </a>
                            </li>
                        @endrole

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow " href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-exchange"></i>
                        </span>
                        <span class="hide-menu">Transaksi</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard.topup.customer') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Kirim Pulsa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('transactions.history') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Riwayat Transaksi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ (request()->routeIs('customers.*') ? 'active' : '' || request()->routeIs('users.*')) ? 'active' : '' }}"
                        href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @role('admin')
                            <li class="sidebar-item">
                                <a href="{{ route('users.index') }}" class="sidebar-link ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Admin</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('users.agen') }}" class="sidebar-link ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Agen</span>
                                </a>
                            </li>
                        @endrole
                        @role('agen')
                            <li class="sidebar-item">
                                <a href="{{ route('customers.index') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Pelanggan</span>
                                </a>
                            </li>
                        @endrole
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ request()->routeIs('configuration.about.*') ? 'active' : '' }}"
                        href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Konfigurasi</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard.contact.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Hubungi Kami</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard.about.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Tentang Kami</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40"
                        height="40" alt="">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                    <span class="fs-2 text-dark">Designer</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button"
                    aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
