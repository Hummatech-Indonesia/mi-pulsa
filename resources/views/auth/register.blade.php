<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jul 2023 02:01:04 GMT -->

<head>
    <!--  Title -->
    <title>Mordenize</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dashboard_assets/dist/css/style.min.css') }}" />
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="index-2.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                                width="180" alt="">
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/login-security.svg"
                                alt="" class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="mb-3 fs-7 fw-bolder">Selamat datang di MiPulsa</h2>

                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="exampleInputtext"
                                            aria-describedby="textHelp" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="email">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="phone_number">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Daftar</button>
                                    <div class="d-flex align-items-center">
                                        <p class="fs-4 mb-0 text-dark">Sudah punya akun?</p>
                                        <a class="text-primary fw-medium ms-2" href="{{ route('login') }}">Masuk</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('dashboard_assets/dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset('dashboard_assets/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dashboard_assets/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dashboard_assets/dist/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('dashboard_assets/dist/js/custom.js') }}"></script>

</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jul 2023 02:01:04 GMT -->

</html>
