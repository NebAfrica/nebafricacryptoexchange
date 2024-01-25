{{-- testimonials --}}
@foreach ($view_data['sections']->where('name', 'testimonials') as $section)
    <section class="testimonial-section padding-top padding-bottom">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="testimonial__img__slider">
                        @foreach ($view_data['testimonials'] as $testimonial)
                            <div class="single-slide">
                                <div class="testimonial__thumb">
                                    <img src="{{ route('file', ['testimonials', $testimonial->photo]) }}"
                                        alt="testimonial">
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial__content__slider">
                        @foreach ($view_data['testimonials'] as $testimonial)
                            <div class="single-slide">
                                <div class="testimonial__content">
                                    <div class="icon"><i class="fas fa-quote-left"></i></div>
                                    <p>{{ $testimonial->comment }}</p>
                                    <h3 class="name">{{ $testimonial->name }}</h3>
                                    <span class="designation text-white">{{ $testimonial->star_rating . '/5' }}</span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
