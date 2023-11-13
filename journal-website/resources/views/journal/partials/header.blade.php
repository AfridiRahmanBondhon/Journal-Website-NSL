<!--header part start  -->
<div id="header-fixed-height"></div>
<header class="website_header" id="sticky-header">
  <nav class="navbar navbar-expand-lg d-none d-lg-block">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}"><img src="{{$siteSetting->logo_small}}" alt="logo-2" width="220"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          {!! WebsiteMenus::menu($frontMenus) !!}
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('content')}}">Content</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('feature')}}">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('faq')}}">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>
  <!-- mobile menu start -->
  <div class="mobile-menu-area d-block d-lg-none">
    <div class="mobile-topbar">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <div class="logo">
            <img src="{{asset('journal_resources')}}/images/main_logo-w.png" alt="logo" width="200">
          </div>
          <div class="bars">
            <i class="fas fa-bars"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu-main">
      <div class="logo">
        <a href="index.html"><img src="{{asset('journal_resources')}}/images/main_logo.png" alt="logo" width="180"></a>
      </div>
      <!-- <div class="mobile-menu-search">
        <form action="#">
          <div class="input-groups position-relative">
            <input type="text" placeholder="Search...">
            <button type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div> -->
      <div class="close-mobile-menu"><i class="fas fa-times"></i></div>
      <div class="menu-body">
        <div class="menu-list">
          <ul class="list-unstyled">
            <li class="sub-mobile-menu">
              <a href="{{route('home')}}">Home</a>
              <!-- <ul class="list-unstyled">
                <li><a href="index.html">Home One</a></li>
                <li><a href="index-2.html">Home Two</a></li>
              </ul> -->
            </li>

            <li class="sub-mobile-menu">
              <a href="{{route('content')}}">Content </a>
            </li>

            <li class="sub-mobile-menu">
              <a href="{{route('faq')}}">FAQ</a>
            </li>
            <li class="sub-mobile-menu">
              <a href="{{route('contact-us')}}">Contact</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- <div class="menu-action-btn">
        <a href="" class="uppercase">Get a quote <i class="fas fa-arrow-right"></i></a>
      </div> -->
    </div>
  </div>
</header>
<!--header part end  -->