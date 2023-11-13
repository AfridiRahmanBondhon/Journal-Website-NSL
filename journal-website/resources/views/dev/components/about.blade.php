  <!-- ======= About Section ======= -->
  <section id="about" class="about">
      <div class="container" data-aos="fade-up">

          <div class="section-title">
              <h2>About</h2>
              <p>{{ $about->title ?? '' }}</p>
          </div>

          <div class="row content">
              <div class="col-lg-6">

                  @php
                      if (!empty($about->description)) {
                          $about_description = $about->description;
                          $length = strlen($about_description);
                          $midpoint = $length / 2;
                      
                          $first = substr($about_description, 0, $midpoint);
                          $second = substr($about_description, $midpoint);
                      }
                  @endphp

                  {!! $first ?? '' !!}
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0">
                  {!! $second ?? '' !!}
                  <a href="{{ route('dev.content.show', $about->slug ?? '') }}" class="btn-learn-more">Learn More</a>
              </div>
          </div>

      </div>
  </section><!-- End About Section -->
