{{-- About us start here --}}
@foreach ($view_data['sections']->where('name', 'about') as $section)
    <section class="choose-us padding-top padding-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="section__thumb rtl">
                        <img src="{{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }}"
                            alt="choose-us">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose__us__content">
                        <div class="section__header mb-0">
                            <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!} </h2>

                        </div>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                        <div class="button__wrapper">
                            <a href="{{ route('about') }}" class="cmn--btn">Know More</a>
                            <a href="{{ route('contact') }}" class="cmn--btn2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
