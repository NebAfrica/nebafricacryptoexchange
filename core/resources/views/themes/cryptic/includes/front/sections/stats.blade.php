@php
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . $units[$i];
    }
@endphp

@foreach ($view_data['sections']->where('name', 'stats') as $section)
    <section class="h-full stat-section bg-[#111f35] text-white pb-28 px-2 md:px-10">
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

        <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 place-items-center" >
            @foreach (json_decode($section->content)->counters as $counter)
                <div class="w-80 lg:w-96 h-44 bg-[#0e1726] text-white rounded-lg p-5" data-aos="fade-up" data-aos-duration="3000">
                    <div class="w-full flex justify-center">
                        <h3 class="text-center text-xl sm-font-4 font-bold">{!! $counter->title !!}</h3>
                    </div>
                    <div class="w-full flex justify-center">
                        <div class="flex space-x-5 items-center">
                            <div>
                                <div class="custom-svg-20">
                                    {!! icon($counter->icon) !!}
                                </div>

                            </div>
                            <div>
                                <div class="">
                                    <h1 class="text-6xl sm-font-6 font-extrabold">{{ shortNumber($counter->count) }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endforeach
