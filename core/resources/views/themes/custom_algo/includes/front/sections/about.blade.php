@foreach ($view_data['sections']->where('name', 'about') as $section)
    <section class="w-full about-section bg-[#111f35] text-white pb-28" >
        <div class="w-full block md:flex justify-between items-center">
            <div class="w-full md:w-1/2 relative">
                <img data-aos="fade-up" data-aos-duration="3000" src="{{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }}"
                    alt="about us">
            </div>

            <div class="w-full md:w-1/2 pr-12 sm-pr-5 sm-pl-5 relative  space-y-14">
                <div class="" data-aos="fade-up" data-aos-duration="3000">
                    <h2 class="capitalize text-6xl sm-font-6 font-bold">{!! json_decode($section->content)->section_heading !!}</h2>
                    <div class="mt-4 h-1 w-1/4 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-duration="3000">
                    <div class="font-semibold text-xl sm-font-4 truncate" id="about-text">
                        {!! json_decode($section->content)->section_text !!}
                    </div>
                    
                </div>

                <div data-aos="fade-up" data-aos-duration="3000">
                    <a href="{{ json_decode($section->content)->section_button_url }}"
                        class="uppercase text-xl sm-font-4 font-bold rounded-full px-10 py-4 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                        {{ json_decode($section->content)->section_button_text }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if (!request()->routeIs('about'))
        <script>
            $(document).ready(function() {
                var about_text = $('#about-text').text();
                var n = 300;
                var new_about_text = (about_text.length > n) ? about_text.slice(0, n - 1) + '...' : about_text;
                $('#about-text').html('<p> ' + new_about_text + ' </p>');
            })
        </script>
    @endif
@endforeach
