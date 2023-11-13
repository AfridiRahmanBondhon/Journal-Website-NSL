<!-- ======= Frequently Asked Questions Section ======= -->
<section id="faq" class="faq">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>F.A.Q</h2>
            <a href="{{ route('dev.notice.index') }}" class="btn btn-danger mt-3">View All</a>
        </div>

        @forelse ($faqs as $item)
            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5">
                    <i class="bx bx-help-circle"></i>
                    <h4>{{ $item->question ?? '' }}</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        {!! $item->answer ?? '' !!}
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->
        @empty
            <x-empty-component></x-empty-component>
        @endforelse


    </div>
</section><!-- End Frequently Asked Questions Section -->
