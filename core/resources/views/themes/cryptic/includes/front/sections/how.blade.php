@foreach ($view_data['sections']->where('name', 'how') as $section)
    <section class="h-full how-section bg-[#111f35] text-white pb-28 px-2 md:px-10">
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
        
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-2 lg:gap-6 place-items-center">
            @foreach (json_decode($section->content)->steps as $step_name => $step)
                <div class="w-11/12 lg:w-[30rem] h-52 bg-[#0e1726] text-white rounded-lg p-5" data-aos="fade-up" data-aos-duration="3000">
                    <div class="flex space-x-5 items-center">
                        <div>
                            <div class="custom-svg">
                                {!! icon($step->icon) !!}
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg sm-font-3 font-bold">{!! ucwords(str_replace('_', ' ', $step_name)) !!}</h4>

                            <div
                                class="mt-4 h-1 w-1/3 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                            </div>

                            <div class="mt-6 pr-5 sm-font-1">
                                <p>{!! $step->text !!}</p>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>
@endforeach
