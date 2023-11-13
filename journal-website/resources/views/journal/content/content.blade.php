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
              <h3>Content</h3>
            </div>
            <div class="col-md-5 align-self-center text-md-end">
              <ul class="list-unstyled">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>Content</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- bread_crumb part end -->

    <!-- content part start -->
    <section class="content">
      <div class="container">
        <div class="content-main">
          <div class="row">
            <div class="col-lg-12">
              <div class="content-box">
                <div class="image">
                  <img src="{{$content->original_image}}" alt="news-details-image-1"
                    class="img-fluid w-100">
                </div>
                <div class="text">
                  {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, amet hic. Quos officiis laudantium
                    illum animi quisquam vitae adipisci unde, sequi ratione maiores quae illo totam aspernatur, nemo a
                    quibusdam ipsam eaque inventore assumenda maxime nulla iusto blanditiis necessitatibus laborum.
                    Asperiores at eum voluptatem autem dicta, laboriosam vel explicabo aliquid maiores doloribus, quia,
                    deserunt ad animi architecto minus nam. Accusamus beatae nesciunt numquam inventore tempore eum odio
                    consequatur saepe voluptatibus, alias ullam cum. Corrupti laudantium mollitia eos fuga tenetur iste
                    quia quae deserunt, eveniet inventore vero blanditiis architecto eius consectetur. Repellendus culpa
                    praesentium autem labore id esse incidunt delectus blanditiis, sit, fuga ex, asperiores tenetur
                    neque
                    necessitatibus nulla eveniet quasi eum? Itaque aliquam voluptates inventore libero eligendi nemo
                    repudiandae sed nobis excepturi reprehenderit eius quis incidunt ex id molestias ab maxime, sapiente
                    doloribus molestiae? Id quia cupiditate, reiciendis officiis nobis molestias cumque in illum eos
                    modi.
                    Saepe cum, natus obcaecati illum exercitationem autem eum nostrum voluptatem esse pariatur ut
                    excepturi perferendis possimus distinctio praesentium ab a. Impedit harum delectus minima ea
                    blanditiis eveniet possimus repellendus, in quam exercitationem ipsam provident magni a velit
                    voluptatem corrupti! Atque molestias esse quibusdam iusto similique quasi, nemo, culpa corporis
                    eligendi aperiam repellendus quaerat minus.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, ea nulla incidunt corporis minima,
                    repellat optio dolorem fuga nisi repudiandae ratione quaerat aliquid ducimus iure sint numquam
                    accusantium nam dignissimos commodi. Inventore totam iste voluptatum, et delectus, suscipit vel
                    debitis voluptates officiis harum saepe error officia possimus quod cumque atque. Corrupti iure
                    fugiat
                    voluptatum incidunt sed architecto, modi ratione nihil est temporibus, tempore, iste autem! Iusto
                    recusandae nam expedita excepturi veniam necessitatibus obcaecati voluptas odio ut, aspernatur
                    dolore
                    quo voluptatum incidunt cum cumque fugit porro. Consequuntur perspiciatis explicabo consectetur sunt
                    tempora alias, sint itaque inventore enim, error totam necessitatibus nemo!</p> --}}
                    {!! $content->description !!}
                </div>
              </div>
              <div class="mid-text my-4 my-lg-5">
                <i class="fas fa-quote-left"></i>
                <h4>
                  {{$content->title}}
                  {{-- In it except to so temper mutual tastes mother. Interested cultivated its continuing Out interested. --}}
                </h4>
              </div>
              <p>
                {{$content->meta_description}}
                {{-- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, ea nulla incidunt corporis minima,
                repellat optio dolorem fuga nisi repudiandae ratione quaerat aliquid ducimus iure sint numquam
                accusantium nam dignissimos commodi. Inventore totam iste voluptatum, et delectus, suscipit vel
                debitis voluptates officiis harum saepe error officia possimus quod cumque atque. Corrupti iure fugiat
                voluptatum incidunt sed architecto, modi ratione nihil est temporibus, tempore, iste autem! Iusto
                recusandae nam expedita excepturi veniam necessitatibus obcaecati voluptas odio ut, aspernatur dolore
                quo voluptatum incidunt cum cumque fugit porro. Consequuntur perspiciatis explicabo consectetur sunt
                tempora alias, sint itaque inventore enim, error totam necessitatibus nemo! --}}
              </p>
                
              <div class="content-table table-responsive">
                <table class="table table-bordered">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contentFiles as $contentFile)
                    <tr>
                      <td>{{$contentFile->id}}</td>
                      <td>
                        {{$contentFile->title}}
                      </td>
                      <td>
                        <a href="{{$contentFile->file}}" class="action"><i class="fas fa-file-pdf">File</i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- content part end -->
  </main>
  <!-- main part end -->
@endsection