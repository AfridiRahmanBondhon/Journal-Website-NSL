<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Nogor CSFD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ without_cache('images/nogor-favicon.png') }}" rel="icon">
    <link href="dev/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ without_cache('dev/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ without_cache('dev/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ without_cache('dev/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ without_cache('dev/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ without_cache('dev/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ without_cache('dev/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ without_cache('dev/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ without_cache('dev/assets/css/style.css') }}" rel="stylesheet">

    <style>
        .nav-item {
            list-style: none !important;
        }

        </st
    </style>

</head>

<body>


    @include('dev.include.header')
    @yield('content')
    @include('dev.include.footer')

    <!-- Vendor JS Files -->
    <script src="{{ without_cache('dev/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ without_cache('dev/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ without_cache('dev/assets/js/main.js') }}"></script>

</body>

</html>
