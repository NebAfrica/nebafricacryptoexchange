{{-- faq section --}}
@foreach ($view_data['sections']->where('name', 'faq') as $section)
    <section class="faq-section padding-top padding-bottom bg_img"
        style="background: url({{ asset('public/assets/themes/prius/assets/images/faq/bg.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="section__header text-center max-p">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="faq__wrapper">
                        @foreach ($view_data['faqs'] as $faq)
                            <div class="faq__item">
                                <div class="faq__item-title">
                                    <h4 class="title">{{ $faq->question }}</h4>
                                </div>
                                <div class="faq__item-content">
                                    <div>
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
