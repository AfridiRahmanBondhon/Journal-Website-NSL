@extends('journal.layouts.journal-master')

@section('content')
    <!-- main part start -->
    <main>

    <!-- bread_crumb part start -->
    <section class="bread_crumb">
      <div class="container">
        <div class="faq_content">
          <div class="row">
            <div class="col-md-7 align-self-center">
              <h3>Contact</h3>
            </div>
            <div class="col-md-5 align-self-center text-md-end">
              <ul class="list-unstyled">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>Features</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- bread_crumb part end -->

    <!-- features part start -->
    <section class="features_list">
      <div class="container">
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
              <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($features as $feature)
                @if($feature->category_id==1)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-collapse{{$feature->id}}" aria-expanded="false" aria-controls="flush-collapse{{$feature->id}}">
                      {{$feature->title}}
                    </button>
                  </h2>
                  <div id="flush-collapse{{$feature->id}}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <p>{{$feature->description}}</p>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                {{-- <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, fugiat.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, fugiat.</p>
                    </div>
                  </div>
                </div> --}}
              </div>
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
              <div class="accordion accordion-flush" id="newAccordionFlushExample">
                @foreach ($features as $feature)
                @if($feature->category_id==2)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#new-flush-collapse{{$feature->id}}" aria-expanded="false"
                      aria-controls="new-flush-collapse{{$feature->id}}">
                      {{$feature->title}}Lorem ipsum dolor, sit
                    </button>
                  </h2>
                  <div id="new-flush-collapse{{$feature->id}}" class="accordion-collapse collapse"
                    data-bs-parent="#newAccordionFlushExample">
                    <div class="accordion-body">
                      <p>{{$feature->description}}</p>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                {{-- <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#new-flush-collapseTwo" aria-expanded="false"
                      aria-controls="new-flush-collapseTwo">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="new-flush-collapseTwo" class="accordion-collapse collapse"
                    data-bs-parent="#newAccordionFlushExample">
                    <div class="accordion-body">
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, fugiat.</p>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#new-flush-collapseThree" aria-expanded="false"
                      aria-controls="new-flush-collapseThree">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="new-flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#newAccordionFlushExample">
                    <div class="accordion-body">
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, fugiat.</p>
                    </div>
                  </div>
                </div> --}}
              </div>

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
              <div class="accordion accordion-flush" id="uniqueAccordion">
                @foreach ($features as $feature)
                @if($feature->category_id==3)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#unique-collapse{{$feature->id}}" aria-expanded="false" aria-controls="unique-collapse{{$feature->id}}">
                            {{$feature->title}}First Title
                        </button>
                    </h2>
                    <div id="unique-collapse{{$feature->id}}" class="accordion-collapse collapse" data-bs-parent="#uniqueAccordion">
                        <div class="accordion-body">
                            <p>{{$feature->description}}Content for the first section.</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                {{-- <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#unique-collapseTwo" aria-expanded="false" aria-controls="unique-collapseTwo">
                            Second Title
                        </button>
                    </h2>
                    <div id="unique-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#uniqueAccordion">
                        <div class="accordion-body">
                            <p>Content for the second section.</p>
                        </div>
                    </div>
                </div>
            
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#unique-collapseThree" aria-expanded="false" aria-controls="unique-collapseThree">
                            Third Title
                        </button>
                    </h2>
                    <div id="unique-collapseThree" class="accordion-collapse collapse" data-bs-parent="#uniqueAccordion">
                        <div class="accordion-body">
                            <p>Content for the third section.</p>
                        </div>
                    </div>
                </div> --}}
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- features part end -->
  </main>
  <!-- main part end -->
@endsection