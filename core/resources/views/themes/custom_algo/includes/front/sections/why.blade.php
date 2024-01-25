@foreach ($view_data['sections']->where('name', 'why') as $section)
    <section class="h-full why-section bg-[#0e1726] text-white pb-28 px-5 md:px-10 lg:px-20">
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

        <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-5 place-items-center" >
            @foreach (json_decode($section->content)->whys as $why)
                <div class="w-11/12 md:w-60 lg:w-72 h-52 bg-[#111f35] text-white rounded-lg p-5" data-aos="fade-up" data-aos-duration="3000">
                    <div class="flex space-x-4 items-center">
                        <div>
                            <div class="custom-svg">
                                {{-- w-14 h-14 text-orange-500 --}}
                                {!! icon($why->icon) !!}
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg sm-font-3 font-bold">{!! $why->title !!}</h4>
                        </div>
                    </div>
                    <div class="mt-6 pr-5 sm-font-1">
                        <p>{!! $why->text !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endforeach
