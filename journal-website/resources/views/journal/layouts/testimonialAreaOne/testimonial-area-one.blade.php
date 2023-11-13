<!-- testimonial part start -->
<section class="testimonial-area-one">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto col-sm-9">
          <div class="common_title text-center">
            <span>Clients Testimonial</span>
            <h2>{{$landingPage->testimonial_text}}
              <img class="common_title_shape" src="{{asset('journal_resources')}}/images/common_title_shape.svg" alt="common_title_shape">
            </h2>
          </div>
        </div>
      </div>
      <div class="row testimonial-area-slider-one">
        @foreach($testimonial as $testimonial)
        <div class="col-lg-6">
          <div class="testimonial-item-one">
            <div class="quote-icon">
              <img src="{{asset('journal_resources')}}/images/quote.png" alt="quote">
            </div>
            <div class="testimonial-avatar d-flex align-items-center">
              <div class="image">
                <img src="{{$testimonial->image}}" alt="testimonial-avatar-1">
              </div>
              <div class="text">
                <h4 class="title">{{$testimonial->name}}</h4>
                <p>{{$testimonial->designation}}</p>
              </div>
            </div>
            <div class="testimonial-info">
              <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <p>{{$testimonial->description}}</p>
            </div>
          </div>
        </div>
        @endforeach
        {{-- <div class="col-lg-6">
          <div class="testimonial-item-one">
            <div class="quote-icon">
              <img src="{{asset('journal_resources')}}/images/quote.png" alt="quote">
            </div>
            <div class="testimonial-avatar d-flex align-items-center">
              <div class="image">
                <img src="{{asset('journal_resources')}}/images/testimonial-avatar-2.png" alt="testimonial-avatar-2">
              </div>
              <div class="text">
                <h4 class="title">Cameron Williamson</h4>
                <p>Dog Trainer</p>
              </div>
            </div>
            <div class="testimonial-info">
              <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <p>There are many variations of passages of lk Lorem Ipsum available, but the majority hjk have suffered
                alteration in some form, byhl injected humour There are many variations of passages of </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="testimonial-item-one">
            <div class="quote-icon">
              <img src="{{asset('journal_resources')}}/images/quote.png" alt="quote">
            </div>
            <div class="testimonial-avatar d-flex align-items-center">
              <div class="image">
                <img src="{{asset('journal_resources')}}/images/testimonial-avatar-1.png" alt="testimonial-avatar-1">
              </div>
              <div class="text">
                <h4 class="title">Savannah Nguyen</h4>
                <p>Dog Trainer</p>
              </div>
            </div>
            <div class="testimonial-info">
              <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <p>There are many variations of passages of lk Lorem Ipsum available, but the majority hjk have suffered
                alteration in some form, byhl injected humour There are many variations of passages of </p>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <!-- testimonial part end -->