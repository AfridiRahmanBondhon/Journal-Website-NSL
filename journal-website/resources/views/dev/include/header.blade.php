<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <img src="{{ without_cache('images/n-logo.png') }}" alt="nogor">
        </h1>
        <nav id="navbar" class="navbar">
            {!! WebsiteMenus::menu($frontMenus) !!}
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
