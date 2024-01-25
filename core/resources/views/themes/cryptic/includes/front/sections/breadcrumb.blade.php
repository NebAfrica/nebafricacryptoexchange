@foreach ($view_data['sections']->where('name', 'breadcrumb') as $section)
    {{-- <section   class="breadcrumb-section" style="background: url({{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }})">        
        <div class="heading">
            <h3><a href="{{ route('index') }}">Home</a>/<a href="{{ request()->url }}"> @if (!request()->is('blog/*')) {{ $page_title }} @else Blog Detail @endif</a></h3>
        </div>
    

    </section> --}}
    <section class="h-full w-full bread bg-[#0e1726] border-b-1">
        <div class="w-full h-full text-white">
            <div class="h-full w-full">
                <div class="h-full w-full overflow-x-hidden">

                    <div class="w-full col-span-2 py-2 pl-5 pr-20 sm-pr-5 ">
                        <div class="w-full flex justify-between items-center">
                            {{-- logo div --}}
                            <div class="pt-2 w-40 md:w-1/3">
                                <a href="/" class="relative"><img
                                        src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}"
                                        alt="logo" class=""></a>
                            </div>
                            <div class="relative w-20 h-6 md:w-60 overflow-hidden" id="google_translate_element"></div>


                            {{-- nav div --}}
                            <nav class="z-20 hidden lg:flex justify-end space-x-5 items-center">
                                <ul class="w-full flex space-x-3">
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('index')) border-b-4 border-orange-600 @endif">
                                        <a href="/">home</a></li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('about')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('about') }}">about</a></li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('plan')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('plans') }}">plan</a></li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('loan')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('plans') }}">loan</a></li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('faq')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('faq') }}">faq</a></li>
                                    <li
                                        class="uppercase text-lg sm-font-4 font-bold @if (request()->routeIs('contact')) border-b-4 border-orange-600 @endif">
                                        <a href="{{ route('contact') }}">contact</a></li>
                                </ul>

                                <div>
                                    <a href="{{ route('login') }}"
                                        class="uppercase text-lg sm-font-3 font-bold rounded-full px-10 py-2 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all flex space-x-1">Login</a>
                                </div>
                            </nav>
                            {{-- mobile nva --}}
                            <div class="lg:hidden">
                                <div class="flex justify-end">
                                    <span class="mobile-menu-trigger z-40">
                                        <svg class="w-8 h-8 md:w-16 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                        </svg>
                                    </span>                                    
                                </div>                             
                                
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
@endforeach

