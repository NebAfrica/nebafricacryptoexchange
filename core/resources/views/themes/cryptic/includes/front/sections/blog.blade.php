@foreach ($view_data['sections']->where('name', 'blog') as $section)
    <section class="w-full h-full plans-section bg-[#111f35] text-white pb-28">
        <div class="pt-32 relative">
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

            <div class="flex justify-center items-center my-7 px-10" data-aos="fade-up" data-aos-duration="3000">
                <div class="font-semibold text-xl sm-font-4">
                    {!! json_decode($section->content)->section_text !!}
                </div>
            </div>
        </div>


        <div
            class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 place-items-center pr-20 pl-20 sm-pl-5 sm-pr-5">
            @foreach ($view_data['blogs'] as $blog)
                <div class="h-96 lg:h-[25rem] w-11/12 rounded-lg bg-[#0e1726] mb-5" data-aos="fade-up"
                    data-aos-duration="3000">
                    <div class="w-full h-1/3">
                        @if ($blog->type == 'auto')
                            <img src="{{ $blog->img }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">
                        @else
                            <img src="{{ route('file', ['blogs', $blog->img]) }}" alt="{{ $blog->title }}"
                                title="{{ $blog->title }}">
                        @endif
                    </div>

                    <div class="mt-10 px-6">
                        <h5 class="text-sm font-medium">{{ $blog->title }} </h5>

                        <p class="mt-5 text-xs">
                            {{ str()->limit($blog->snippet, 90, '...') }}
                        </p>

                        <p class="mt-5 text-sm">
                            {{ $blog->author }} | {{ $blog->category }} |
                            {{ formatPastDate(strtotime($blog->created_at)) }}
                        </p>
                    </div>

                    <div class="w-full mt-5 pl-6 relative z-2">

                        @if ($blog->type !== 'auto')
                            <a href="{{ route('blog-detail', [$blog->slug]) }}"
                                class="uppercase text-xs font-bold rounded-md px-3 py-1 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                                read more
                            </a>
                        @else
                            <a href="{{ $blog->slug }}" target="_blank" rel="noopener noreferrer nofollow"
                                class="uppercase text-xs font-bold rounded-md px-3 py-1 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                                read more
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="w-full grid grid-cols-1 place-items-center pr-20 pl-20 sm-pl-5 sm-pr-5 mt-10">
            @if (request()->routeIs('blogs'))
                <div class="pagination relative z-2">
                    {{ $view_data['blogs']->links() }}
                </div>
            @else
                <p class="relative z-2">
                    <a href="{{ route('blogs') }}" class="border-b-2">View More</a>
                </p>
            @endif

        </div>

    </section>
@endforeach
