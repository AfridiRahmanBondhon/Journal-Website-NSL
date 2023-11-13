 <!-- ======= Hero Section ======= -->
 <section id="hero">
     <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

         <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
         <div class="carousel-inner" role="listbox">

             @if ($slider)
                 @forelse ($slider->details ?? ''  as $slider)
                     <div class="carousel-item active" style="background-image: url({{ $slider->original_image }})">
                         <div class="carousel-container">
                             <div class="container">
                                 <h2 class="animate__animated animate__fadeInDown">{{ $slider->title ?? '' }}</h2>
                                 <p class="animate__animated animate__fadeInUp">{!! $slider->description ?? '' !!}</p>

                                 @if ($slider->has_button == 'Yes')
                                     <a href="{{ $slider->url ?? '' }}"
                                         class="btn-get-started animate__animated animate__fadeInUp scrollto">
                                         {{ $slider->button_name }}</a>
                                 @endif
                             </div>
                         </div>
                     </div>
                 @empty
                     <x-empty-component></x-empty-component>
                 @endforelse
             @endif

         </div>
         <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
             <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
         </a>

         <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
             <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
         </a>

     </div>
 </section><!-- End Hero -->
