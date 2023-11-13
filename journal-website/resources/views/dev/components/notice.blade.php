<!-- ======= Event Section ======= -->
<section id="services" class="services">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Notice</h2>
            <a href="{{ route('dev.notice.index') }}" class="btn btn-danger mt-3">View All</a>
        </div>

        <div class="row">
            @forelse ($notices as $item)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <h4><a href="{{ route('dev.notice.show', $item->slug) }}">{{ $item->title ?? '' }}</a></h4>
                    </div>
                </div>
            @empty
                <x-empty-component></x-empty-component>
            @endforelse

        </div>
    </div>
</section><!-- End Services Section -->
