<!-- video part start -->
<section class="video_section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="position-relative">
            <div class="video position-relative">
              <img src="{{asset('journal_resources')}}/images/video.jpg" alt="video" class="img-fluid w-100">
              <a class="vidplay" href="{{$landingPage->video_link_url}}">
                <div class="video-icon">
                  <svg class="play" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                      d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" />
                    </svg>
                </div>
              </a>
            </div>
            <img class="video_shape" src="{{asset('journal_resources')}}/images/banner-shape-2.svg" alt="">
          </div>
        </div>
        <div class="col-lg-6 ps-lg-4 ps-xxl-5 align-self-center">
          <div class="video_content mt-5 mt-lg-0">
            <div class="common_title text-start">
              <span>Video</span>
              <h2>{{$landingPage->video_title}}
                <img class="common_title_shape" src="{{asset('journal_resources')}}/images/common_title_shape.svg" alt="common_title_shape">
              </h2>
            </div>
            <p>{{$landingPage->video_description}}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- video part end -->