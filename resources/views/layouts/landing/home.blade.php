<!DOCTYPE html>
<html lang="en">


<!-- molla/category-market.html  22 Nov 2019 10:02:55 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Badminton</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('templateLandings/assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('templateLandings/assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('templateLandings/assets/images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('templateLandings/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('templateLandings/assets/images/icons/safari-pinned-tab.svg') }}"
        color="#666666">
    <link rel="shortcut icon" href="{{ asset('templateLandings/assets/images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('templateLandings/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/plugins/nouislider/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/skins/skin-demo-13.css') }}">
    <link rel="stylesheet" href="{{ asset('templateLandings/assets/css/demos/demo-13.css') }}">
    <link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/toastr/toastr.min.css') }}">


    @yield('css')
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-10">
            <div class="header-middle">
                <div class="container">
                    @include('layouts.landing.header.header-left')
                    <!-- End .header-left -->

                    @include('layouts.landing.header.header-right')
                    <!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header" style="background-color: #0D13A1">
                @include('layouts.landing.header.header-bottom')
                <!-- End .container -->
            </div><!-- End .header-bottom -->


        </header><!-- End .header -->



        <main class="main">

            @yield('content')
            <!-- End .page-content -->
            <!-- End .cta -->
        </main><!-- End .main -->

        <footer class="footer footer-2">
            <div class="cta cta-horizontal cta-horizontal-box ">
                <div class="container">
                    <div class="row align-items-center bg">
                        <div class="col-lg-3">
                            <img src="{{ asset('templates/img/logo-removebg-preview.png') }}" alt="Molla Logo"
                                width="50" height="25">
                            <!-- End .cta-desc -->
                        </div><!-- End .col-lg-5 -->
                        <div class="col-lg-6">
                            <center>
                                <h2>Badminton</h2>
                            </center>

                            <!-- End .cta-desc -->
                        </div><!-- End .col-lg-5 -->
                        <div class="col-lg-3">
                            <img src="{{ asset('templates/img/logo-removebg-preview.png') }}" style="float:right;"
                                alt="Molla Logo" width="50" height="25">
                            <!-- End .cta-desc -->
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div>
            <!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <!-- Plugins JS File -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('templateLandings/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('templateLandings/assets/js/main.js') }}"></script>
    <script src="{{ asset('templatesAdminLTE/plugins/toastr/toastr.min.js') }}"></script>

    @yield('script')
    <script>
        @if (Session::has('success'))
            ;
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('info'))
            ;
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('error'))
            ;
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('warning'))
            ;
            toastr.warning("{{ session('warning') }}");
        @endif

        function logout() {
            event.preventDefault();
            $("#logout-form").submit();
        }
    </script>
</body>


<!-- molla/category-market.html  22 Nov 2019 10:03:00 GMT -->

</html>
