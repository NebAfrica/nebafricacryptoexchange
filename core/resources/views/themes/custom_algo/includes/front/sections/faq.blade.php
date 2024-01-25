@foreach ($view_data['sections']->where('name', 'faq') as $section)
    <section class="w-full h-full faq-section bg-[#0e1726] text-white pb-28">
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

        @foreach ($view_data['faqs'] as $faq)
            <div class="w-full flex justify-center my-7" data-aos="fade-up" data-aos-duration="3000">
                <div x-data="{ open: false }" class="bg-[#111f35] rounded-3xl w-11/12 md:w-3/5 p-5">
                    <div @click="open = ! open"
                        class="p-4 bg-transparent w-full rounded flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                            </svg>

                            <h4 class="capitalize font-semibold text-xl sm-font-4">{{ $faq->question }}</h4>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 text-orange-500 transition-all duration-300"
                            :class="open ? 'rotate-90' : 'rotate-0'">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                        </svg>
                    </div>
                    <div x-show="open" @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-0"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-y-10"
                        x-transition:leave-end="opacity-0 translate-y-0" class="w-full p-6">
                        <div class="text-white bg-gray-600 rounded-md p-4">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endforeach
