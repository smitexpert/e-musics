<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    @stack('styles')
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('dashboard.layouts.partial.menu')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('dashboard.layouts.partial.sidebar')
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content min-vh-100">
                    @yield('contents')
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            {{-- <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © {{ date('Y') }} Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('dashboard') }}/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('dashboard') }}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('dashboard') }}/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="{{ asset('dashboard') }}/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/js/dashboard-ecommerce.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>
 
</html>