<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jul 2023 02:01:04 GMT -->

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
                                @if (session('success'))
                                    <x-alert-success></x-alert-success>
                                @elseif ($errors->any())
                                    <x-validation-errors :errors="$errors"></x-validation-errors>
                                @elseif(session('error'))
                                    <x-alert-failed></x-alert-failed>
                                @endif
                                <h2 class="mb-3 fs-7 fw-bolder">Selamat datang di MiPulsa</h2>

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="email" placeholder="mipulsa@gmail.com"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <div class="d-flex align-items-center">
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                name="password" placeholder="password">
                                            <i class="ti ti-eye" id="togglePassword"
                                                style="z-index: 100; margin-left:-10%;"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="1"
                                                name="remember" id="flexCheckChecked"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Ingat perangkat ini
                                            </label>
                                        </div>
                                        <a class="text-primary fw-medium" href="{{ route('password.request') }}">Lupa
                                            Password ?</a>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 mb-4 rounded-2">Masuk</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-medium">Baru di MiPulsa?</p>
                                        <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Buat
                                            akun</a>
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
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                // Dapatkan input password
                var passwordField = $('#exampleInputPassword1');
                var passwordFieldType = passwordField.attr('type');

                // Ubah tipe input
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $(this).removeClass('ti ti-eye').addClass('ti ti-eye-off');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).removeClass('ti ti-eye-off').addClass('ti ti-eye');
                }
            });
        });
    </script>



</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jul 2023 02:01:04 GMT -->

</html>
