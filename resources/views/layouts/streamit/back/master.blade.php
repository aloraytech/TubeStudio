<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Keywords" content="{{$system->keywords}}">
    <meta name="Description" content="{{$system->desc}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset($system->favicon)}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/back/css/bootstrap.min.css')}}">
    <!--datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/back/css/dataTables.bootstrap4.min.css')}}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('assets/back/css/typography.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/back/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/back/css/responsive.css')}}">
</head>
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">
@include('layouts.streamit.back.components.sidebar')
@include('layouts.streamit.back.components.topnav')
    <!-- Page Content  -->
@yield('content')
</div>
<!-- Wrapper END -->
@include('layouts.streamit.back.components.footer')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/back/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/back/js/popper.min.js')}}"></script>
<script src="{{asset('assets/back/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/back/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/back/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Appear JavaScript -->
<script src="{{asset('assets/back/js/jquery.appear.js')}}"></script>
<!-- Countdown JavaScript -->
<script src="{{asset('assets/back/js/countdown.min.js')}}"></script>
<!-- Select2 JavaScript -->
<script src="{{asset('assets/back/js/select2.min.js')}}"></script>
<!-- Counterup JavaScript -->
<script src="{{asset('assets/back/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets/back/js/jquery.counterup.min.js')}}"></script>
<!-- Wow JavaScript -->
<script src="{{asset('assets/back/js/wow.min.js')}}"></script>
<!-- Slick JavaScript -->
<script src="{{asset('assets/back/js/slick.min.js')}}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{asset('assets/back/js/owl.carousel.min.js')}}"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{asset('assets/back/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{asset('assets/back/js/smooth-scrollbar.js')}}"></script>
<!-- apex Custom JavaScript -->
<script src="{{asset('assets/back/js/apexcharts.js')}}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{asset('assets/back/js/chart-custom.js')}}"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/back/js/custom.js')}}"></script>
</body>
</html>
