 <!-- ======= Portfolio Section ======= -->
 <section id="portfolio" class="portfolio">
     <div class="container" data-aos="fade-up">

         <div class="section-title">
             <h2>Gallery</h2>
             <p>Check our Gallery</p>
         </div>

         <div class="row" data-aos="fade-up" data-aos-delay="100">
             <div class="col-lg-12 d-flex justify-content-center">
                 <ul id="portfolio-flters">
                     <li data-filter="">ALL</li>
                     <li data-filter=".filter-app">Photo</li>
                     <li data-filter=".filter-card">Video</li>
                 </ul>
             </div>
         </div>

         <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

             @forelse ($photos as $item)
                 <a href="{{ route('dev.photos.index', $item->slug) }}">
                     <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                         <img src="{{ $item->original_image ?? '' }}" class="img-fluid" alt="">
                         <div class="portfolio-info">
                             <h4>{{ $item->name ?? '' }}</h4>
                         </div>
                     </div>
                 </a>
             @empty
             @endforelse

             @forelse ($videos as $item)
                 <a href="{{ route('dev.videos.index', $item->slug) }}">
                     <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                         <img src="{{ $item->original_image ?? '' }}" class="img-fluid" alt="">
                         <div class="portfolio-info">
                             <h4>{{ $item->name }}</h4>
                         </div>
                     </div>
                 </a>
             @empty
             @endforelse

         </div>
     </div>
 </section><!-- End Portfolio Section -->
