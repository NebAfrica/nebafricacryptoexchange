@foreach ($view_data['sections']->where('name', 'testimonials') as $section)
    <section class="h-full contact-section bg-[#111f35] text-white pb-28 px-10">
        <div class="pt-32">
            <div class="flex justify-center" data-aos="fade-up" data-aos-duration="3000">
                <div class="flex justify-center items-center">
                    <div>
                        <h2 class="capitalize text-6xl sm-font-6 font-bold">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div
                            class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                        </div>
                    </div>
                </div>
            </div>

            <div  class="flex justify-center items-center my-7 px-10" data-aos="fade-up" data-aos-duration="3000">
                <div class="font-semibold text-xl sm-font-4">
                    {!! json_decode($section->content)->section_text !!}
                </div>
            </div>
        </div>


        <div class="w-full flex justify-center owl-carousel owl-theme reviews" data-count="2" data-aos="fade-up" data-aos-duration="3000">
            @foreach ($view_data['testimonials'] as $testimonial)
                <div class="w-11/12 lg:w-[32rem] h-52 bg-[#0e1726] text-white rounded-lg p-1 md:p-5">
                    <div class="w-full h-full flex justify-center pl-8 pr-4">
                        <div
                            class="pr-12 w-full h-full flex items-center bg-[url('../../../../../../../../public/assets/ifront/testimonial.png')] bg-contain bg-center bg-no-repeat">

                            <div class="h-24 w-24 rounded-full relative -left-3">
                                <div class="w-8 md:w-16">
                                    <img src="{{ route('file', ['testimonials', $testimonial->photo]) }}"
                                        alt="{{ $testimonial->name }}" title="{{ $testimonial->name }}"
                                        class="rounded-full">
                                </div>
                            </div>

                            <div>
                                <h3 class="font-semibold text-orange-500">{{ $testimonial->name }}</h3>
                                <div class="flex items-center h-24 overflow-hidden">
                                    <p><i>{{ $testimonial->comment }}</i></p>
                                </div>
                                <div class="flex justify-center">
                                    <p><span
                                            class="text-white bg-green-500 p-1 rounded">{{ $testimonial->star_rating . '/5' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </section>

    <script>
        $('.reviews').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: 5000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                }
            }
        })
    </script>
@endforeach
