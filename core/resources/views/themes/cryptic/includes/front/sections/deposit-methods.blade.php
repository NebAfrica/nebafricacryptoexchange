@foreach ($view_data['sections']->where('name', 'deposit_methods') as $section)
    <section class="h-full hero-section bg-[#0e1726] text-white px-16 pb-28">
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

        <div data-aos="fade-up" data-aos-duration="3000" class="w-full grid grid-cols-1 lg:grid-cols-4 place-items-center owl-carousel owl-theme payment-methods">
            @foreach ($view_data['methods'] as $method)
                <div class="w-full md:w-52 h-32 overflow-x-hidden overflow-y-hidden bg-white rounded-full flex justify-center items-center">
                    <div class="w-1/2">
                        <img src="{{ route('file', ['deposit-methods', $method->logo]) }}" alt="{{ $method->name }}"
                            title="{{ $method->name }}">
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script>
        $('.payment-methods').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: 5000,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 4
                }
            }
        })
    </script>
@endforeach
