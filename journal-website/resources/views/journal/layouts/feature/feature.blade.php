<!-- feature part start -->
<section class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto col-sm-9">
          <div class="common_title text-center">
            <span>Features</span>
            <h2>{{$landingPage->feature_text}}
              <img class="common_title_shape" src="{{asset('journal_resources')}}/images/common_title_shape.svg" alt="common_title_shape">
            </h2>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 mx-md-auto feature_label">
          <div class="feature_box">
            <div class="feature_item d-flex align-items-center">
              <div class="icon">
                <i class="fas fa-chess-queen"></i>
              </div>
              <div class="title">
                <h3>Author Panel</h3>
              </div>
            </div>
            <ul class="list list-unstyled">
              @foreach ($features as $feature)
              @if($feature->category_id==1)
              <li>{{$feature->title}}</li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-md-auto feature_label">
          <div class="feature_box">
            <div class="feature_item d-flex align-items-center">
              <div class="icon">
                <i class="fas fa-chess-queen"></i>
              </div>
              <div class="title">
                <h3>Admin Panel</h3>
              </div>
            </div>
            <ul class="list list-unstyled">
              @foreach ($features as $feature)
              @if($feature->category_id==2)
              <li>{{$feature->title}}</li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-md-auto feature_label">
          <div class="feature_box">
            <div class="feature_item d-flex align-items-center">
              <div class="icon">
                <i class="fas fa-chess-queen"></i>
              </div>
              <div class="title">
                <h3>Editorial Board</h3>
              </div>
            </div>
            <ul class="list list-unstyled">
              @foreach ($features as $feature)
              @if($feature->category_id==3)
              <li>{{$feature->title}}</li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- feature part end -->