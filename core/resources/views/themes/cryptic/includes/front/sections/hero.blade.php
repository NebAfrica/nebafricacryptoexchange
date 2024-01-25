@foreach ($view_data['sections']->where('name', 'hero') as $section)
    <section class="h-full w-full hero-section bg-[#0e1726]">
        <div class="w-full h-full text-white">
            <div class="h-full w-full">
                <div class="h-full w-full overflow-x-hidden  overflow-y-hidden">

                    <div class="w-full col-span-2 py-2 pl-5 pr-20 sm-pr-5">
                        <div class="w-full flex justify-between items-center">
                            {{-- logo div --}}
                            <div class="pt-2 w-40 md:w-1/3">
                                <a href="/" class="relative"><img
                                        src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}"
                                        alt="logo" class=""></a>
                            </div>

                            <div class="relative w-20 h-6 md:w-60 overflow-hidden" id="google_translate_element"></div>

                            {{-- nav div --}}
                            <nav class="z-20 hidden lg:flex space-x-5 pl-5 items-center">
                                <ul class="w-full flex space-x-3">
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('index')) border-b-4 border-orange-600 @endif">
                                        <a href="/">home</a>
                                    </li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('about')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('about') }}">about</a>
                                    </li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('plan')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('plans') }}">plan</a>
                                    </li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('loan')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('plans') }}">loan</a>
                                    </li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('faq')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('faq') }}">faq</a>
                                    </li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('contact')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('contact') }}">contact</a>
                                    </li>
                                </ul>

                                <div>
                                    <a href="{{ route('login') }}"
                                        class="uppercase text-lg sm-font-3 font-bold rounded-full px-10 py-2 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">Login</a>
                                </div>
                            </nav>
                            {{-- mobile nva --}}
                            <div class="lg:hidden">
                                <div class="flex justify-end">
                                    <span class="mobile-menu-trigger z-40">
                                        <svg class="w-8 h-8 md:w-16 md:h-16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16m-7 6h7"></path>
                                        </svg>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- hero --}}
                    <div class="w-full grid grid-cols-1 lg:grid-cols-2">
                        <div class="pl-20 sm-pl-5 pr-6 z-10">
                            <h1 data-aos="fade-up" data-aos-duration="3000" class="mt-28 capitalize text-6xl sm-font-6 font-bold">{!! json_decode($section->content)->section_heading !!}</h1>

                            <div data-aos="fade-up" data-aos-duration="3000" class="mt-10 font-semibold text-xl sm-font-4">
                                {!! json_decode($section->content)->section_text !!}

                                <div class="mt-20 mb-24">
                                    <a href="{{ json_decode($section->content)->section_button_url }}"
                                        class="uppercase text-xl sm-font-4 font-bold rounded-full px-14 py-4 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                                        {{ json_decode($section->content)->section_button_text }}
                                    </a>
                                </div>
                            </div>


                        </div>
                        <div class="relative h-[48rem] -top-44 bg-no-repeat hidden lg:flex" data-aos="fade-up" data-aos-duration="3000"
                            style="background: url({{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }})">
                        </div>
                        <div class="h-6 lg:hidden">
                            <img style="z-index: 0" class="relative  -right-28 -sm-100 -md-150"
                                src="{{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
