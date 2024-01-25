@foreach ($view_data['sections']->where('name', 'breadcrumb') as $section)
    <div class="inner-banner section-bg overflow-hidden">
        <div class="container">
            <div class="inner__banner__content text-center">
                <h2 class="title">{{ $page_title }}</h2>
                <ul class="breadcums d-flex flex-wrap justify-content-center">
                    <li><a href="url('/')">Home</a>//</li>
                    <li>{{ $page_title }}</li>
                </ul>
            </div>
        </div>
        <div class="shapes">
            <img src="{{ asset('public/assets/themes/prius/assets/images/banner/inner-bg.png') }}" alt="banner" class="shape shape1">
            <img src="{{ asset('public/assets/themes/prius/assets/images/banner/inner-thumb.png') }}" alt="banner" class="shape shape2 d-none d-lg-block">
        </div>
    </div>
   
@endforeach
