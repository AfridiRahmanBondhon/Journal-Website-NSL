<!DOCTYPE html>
<html>

<head data-baseurl="{{ URL::to('/') }}">
    <meta charset="utf-8">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon Icon -->
    <link rel='icon' type='image/png' sizes='32x32' href="{{ $siteSetting->favicon }}">

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
    <script src="{{ asset('extra/fontawesome-kit.js') }}" crossorigin="anonymous"></script>

    <!-- Css -->
    <link href="{{ without_cache('css/app.css') }}" rel="stylesheet">
    <link href="{{ without_cache('assets/css/admin.css') }}" rel="stylesheet">
    <link href="{{ without_cache('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ without_cache('css/admin_layouts.css') }}" rel="stylesheet">

    <style>
        .ui-datepicker {
            z-index: 9 !important;
            margin-top: 5px;
        }
    </style>

</head>

<body class="sidebar">

    <!-- Vue Instance -->
    <div id="app">
        <app />
    </div>

    <!-- Script -->
    <script src="{{ without_cache('js/app.js') }}" defer></script>
    <script src="{{ without_cache('js/admin_layouts.js') }}"></script>
    <script src="{{ without_cache('extra/dist/fast-image-zoom.js') }}"></script>
    <script src="{{ without_cache('ckeditor/ckeditor.js') }}"></script>
    <script>
        const destroy = imageZoom({
            selector: `img:not([data-image-zoom-disabled])`,
            containerSelector: null,
            cb: () => {},
            exceed: false,
            padding: 10,
        })
    </script>

</body>

</html>
