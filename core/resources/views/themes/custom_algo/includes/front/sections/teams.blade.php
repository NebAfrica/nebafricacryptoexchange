@foreach ($view_data['sections']->where('name', 'teams') as $section)
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

        <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 place-items-center">
            @foreach ($view_data['teams'] as $team)
                <div class="w-11/12 md:w-56 h-72 bg-[#0e1726] text-white rounded-lg p-3" data-aos="fade-up" data-aos-duration="3000">
                    <div class="w-full h-3/4 flex justify-center">
                        <img class="h-40 w-40 rounded-full" src="{{ route('file', ['teams', $team->photo]) }}" alt="team member photo">
                    </div>
                    <div class="w-full h-1/4 flex justify-center">
                        <div>
                            <div>
                                <h2 class="text-xl sm-font-4 font-semibold text-center">{{ $team->name }}</h2>
                            </div>
                            <div>
                                <h5 class="text-center">{{ $team->role }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endforeach
