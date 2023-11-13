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
              <h3>FAQ’s About Journal Submission System</h3>
            </div>
            <div class="col-md-5 align-self-center text-md-end">
              <ul class="list-unstyled">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>FAQ</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- bread_crumb part end -->

    <!-- faq part start -->
    <section class="faq">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="faq-body">
              <div class="accordion" id="accordionExample">
                @foreach($faqs as $faq)
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                      {{$faq->question}}
                    </button>
                  </h2>
                  <div id="collapse{{$faq->id}}" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>{!! $faq->answer !!}</p>
                    </div>
                  </div>
                </div>
                @endforeach
                {{--<div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      How do I access the journal submission system?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Access to the submission system is typically provided through the journal's website. Authors
                        and reviewers can log in using their credentials or create an account if necessary.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      What types of files can I upload when submitting a manuscript?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Most journal submission systems accept common file formats like PDF, Word documents, and LaTeX
                        files for manuscripts. However, it's essential to check the specific requirements of the
                        journal.</p>
                    </div>
                  </div>
                </div>
                {{--<div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Can I track the status of my submission in the system?
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Yes, journal submission systems often provide features that allow authors to track the status
                        of
                        their submission, from initial submission to reviews and eventual publication.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class "accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      How can I withdraw a submitted manuscript?
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>To withdraw a manuscript, authors typically need to log in to the system and follow the
                        journal's
                        withdrawal procedure, which can usually be found in the submission guidelines.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      What should I do if I encounter technical issues while using the system?
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>If you encounter technical problems, you should contact the journal's technical support or
                        helpdesk.
                        They can assist with troubleshooting and resolving any issues.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      How do I select the appropriate category for my submission?
                    </button>
                  </h2>
                  <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Most journal submission systems have a drop-down menu or category selection during the
                        submission
                        process. You should choose the category that best fits your manuscript's subject matter.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                      Can I submit multiple manuscripts to the same journal through the submission system?
                    </button>
                  </h2>
                  <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Yes, many submission systems allow authors to submit multiple manuscripts, but there may be
                        limitations or guidelines regarding the number of submissions allowed.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                      Is there a fee for using the journal submission system?
                    </button>
                  </h2>
                  <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Using the submission system itself is usually free. However, some journals may charge
                        submission
                        or publication fees, which should be outlined in the journal's guidelines.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                      How can I submit supplementary materials, such as data or multimedia files?
                    </button>
                  </h2>
                  <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>If the journal allows supplementary materials, the submission system typically provides an
                        option
                        to upload them along with the manuscript. Follow the guidelines and instructions for including
                        supplementary materials.</p>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- faq part end -->
  </main>
  <!-- main part end -->
@endsection