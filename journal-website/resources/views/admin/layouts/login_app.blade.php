<!DOCTYPE html>
<html>

<head data-baseurl="{{ URL::to('/') }}">
    <meta charset="utf-8">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon Icon -->
    <link rel='icon' type='image/png' sizes='32x32' href="{{ $siteSetting->favicon ?? '' }}">

    <!-- Cache Invalidation -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ URL::to('/') }}" />

    <!-- Laravel Config -->
    <script>
        window.laravel = {
            csrfToken: '{{ csrf_token() }}',
            baseurl: '{{ URL::to('/') }}'
        }
    </script>

    <title>{{ config('app.name') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/3f4c7459cb.js" crossorigin="anonymous"></script>

    <!-- Css -->
    <link rel="stylesheet" href="{{ without_cache('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ without_cache('assets/css/smooth-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ without_cache('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ without_cache('assets/css/fix.css') }}">
    <link rel="stylesheet" href="{{ without_cache('assets/css/responsive.css') }}">

</head>

<body>

    <!-- Vue Instance -->
    <div id="app">
        <login token="{{ $token ?? '' }}" />
    </div>

    <!-- Script -->
    <script src="{{ without_cache('js/login_app.js') }}" defer></script>
    <script src="{{ without_cache('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ without_cache('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ without_cache('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ without_cache('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ without_cache('assets/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ without_cache('assets/js/script.js') }}"></script>
</body>

</html>
