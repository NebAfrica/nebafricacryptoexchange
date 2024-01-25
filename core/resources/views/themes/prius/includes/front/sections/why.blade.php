{{-- why choose us --}}
@foreach ($view_data['sections']->where('name', 'why') as $section)
    <section class="feature-section padding-bottom overflow-hidden">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section__header text-center">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature__slider">
                @foreach (json_decode($section->content)->whys as $why)
                    <div class="single-slide">
                        <div class="feature__item">
                            <div class="feature__item-icon custom-svg text-warning">
                                {!! icon($why->icon) !!}
                            </div>
                            <div class="feature__item-content">
                                <h4 class="title">{!! $why->title !!}</h4>
                                <p>{!! $why->text !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endforeach
