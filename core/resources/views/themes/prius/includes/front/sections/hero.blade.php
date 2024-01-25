{{-- Hero section --}}
@foreach ($view_data['sections']->where('name', 'hero') as $section)
    <section class="banner-section overflow-hidden">
        <div class="container">
            <div class="banner__wrapper d-flex align-items-center justify-content-between">
                <div class="banner__content">
                    <h1 class="title">{!! json_decode($section->content)->section_heading !!}</h1>
                    <div>
                        {!! json_decode($section->content)->section_text !!}
                    </div>
                    <a href="{{ json_decode($section->content)->section_button_url }}"
                        class="cmn--btn">{{ json_decode($section->content)->section_button_text }}</a>
                </div>
                <div class="banner__thumb d-none d-lg-block">
                    {{-- <img src="{{ asset('public/assets/themes/prius/assets/images/banner/thumb.png') }}" alt="banner"> --}}
                    <img width="100%"
                        src="{{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }}"
                        alt="image">
                    <div class="shapes">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/banner/big-coin.png') }}"
                            alt="banner" class="shape shape1">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/banner/light.png') }}"
                            alt="banner" class="shape shape2">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/banner/sm-coin.png') }}"
                            alt="banner" class="shape shape3">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/banner/sm-coin.png') }}"
                            alt="banner" class="shape shape4">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
