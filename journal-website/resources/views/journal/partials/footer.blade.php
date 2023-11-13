  <!-- footer part start -->
  <button class="scroll-to-top">
    <i class="fas fa-angle-up"></i>
  </button>
  <footer class="website_footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <div class="widget">
            <a href="{{route('home')}}"><img class="mb-4" src="{{$siteSetting->favicon}}" alt="logo" width="220"></a>
            <p class="mb-4">
              Lorem ipsum dolor sit amet consecteturicing elit. Deserunt, quisquam!
            </p>
            <nav class="nav social">
              <a href="{{ $siteSetting->tw ?? '' }}"><i class="fab fa-twitter"></i></a>
              <a href="{{ $siteSetting->fb ?? '' }}"><i class="fab fa-facebook-f"></i></a>
              <a href="{{ $siteSetting->dbl ?? '' }}"><i class="fab fa-dribbble"></i></a>
              <a href="{{ $siteSetting->ig ?? '' }}"><i class="fab fa-instagram"></i></a>
              <a href="{{ $siteSetting->yt ?? '' }}"><i class="fab fa-youtube"></i></a>
            </nav>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <div class="widget">
            <h4 class="widget-title  mb-3">Get in Touch</h4>
            <address>Moonshine St. 14/05 Light City, London, United Kingdom</address>
            <a href="{{ $siteSetting->contact_email ?? '' }}">{{ $siteSetting->contact_email ?? '' }}</a><br> <a href="{{ $siteSetting->mobile1 ?? '' }}">{{ $siteSetting->mobile1 ?? '' }}</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 ps-lg-5">
          <div class="widget">
            <h4 class="widget-title  mb-3">Learn More</h4>
            <ul class="list-unstyled">
              {!! WebsiteMenus::footerMenu($footerMenu) !!}
              {{-- <li><a href="#">About Us</a></li>
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Privacy Policy</a></li> --}}
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <div class="widget">
            <h4 class="widget-title mb-3">Our Newsletter</h4>
            <p class="mb-3">Subscribe to our newsletter to get our news &amp; deals delivered to you.</p>
            <div class="subscribe">
              <form action="{{route('news-letter')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input_groups">
                  <input type="email" name="email" placeholder="Subscribe">
                  @error('email')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </div>
                
                <h1 class="text-success">
                  
                  @if(Session::has('success'))
                    <script>
                      Swal.fire({
                        title: 'Success!',
                        text: "{{Session::get('success')}}",
                        icon: 'success',
                        confirmButtonText: 'OK'
                      })
                    </script>
                  @endif
                </h1>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer_btm">
        <div class="row">
          <div class="col-md-12">
            <div class="text text-center">
              <p>&copy; All right reserved by: <a href="{{ $siteSetting->web ?? '' }}">Nogor solutions limited</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  @include('sweetalert::alert')
