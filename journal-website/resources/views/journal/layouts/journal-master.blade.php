<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes">
  <title>Nogor Journal</title>
  <!--all css link -->
  <link rel="stylesheet" href="{{asset('journal_resources/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/fontawsome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/fontawsome/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/fonts.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/slick.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('journal_resources/css/responsive.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>

  <div id="app">
    @include('journal.partials.header')
    @yield('content')
    @include('journal.partials.footer')
  </div>

  <!-- cookie section start -->
  <section id="cookies">
    <div class="container">
      <div class="cookies">
        <div class="row">
          <div class="col-lg-9 align-self-lg-center">
            <div class="info">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium earum aliquam saepe ducimus
                repudiandae impedit eaque sit excepturi recusandae voluptates!</p>
            </div>
          </div>
          <div class="col-lg-3 align-self-lg-center">
            <div class="text-end">
              <button id="cookies-btn">Accept All</button>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- cookie section end -->

  <!-- all js link -->
  @include('sweetalert::alert')
  <script src="{{asset('journal_resources/js/jquery-1.12.4.min.js')}}"></script>
  <script src="{{asset('journal_resources/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('journal_resources/js/slick.min.js')}}"></script>
  <script src="{{asset('journal_resources/js/wow.min.js')}}"></script>
  <script src="{{asset('journal_resources/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('journal_resources/js/script.js')}}"></script>
</body>

</html>