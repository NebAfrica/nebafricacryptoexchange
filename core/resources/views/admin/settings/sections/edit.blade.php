@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            {{ $page_title }}
                        </h2>
                    </div>

                    <div>
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')

    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

                <div class="p-2 md:p-4">
                    <form class="mt-2 p-2 md:p-4"
                        action="{{ route('admin.settings.sections.edit-validate', $section->id) }}" method="post"
                        enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="name" id="" value="{{ $section->name }}">


                        @if ($section->name != 'breadcrumb')
                            {{--  section heading --}}
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full flex items-baseline space-x-1">
                                    <label class="font-medium" for="section_heading">Section Heading:</label>
                                    <input
                                        class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                        type="text" name="section_heading" id="section_heading"
                                        value="{{ old('section_heading') ?? json_decode(json_decode($section)->content)->section_heading }}"
                                        required>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('section_heading')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            {{--  section heading end --}}


                            {{--  section text starts here --}}
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1">
                                    <label class="font-medium mb-2" for="section_text">Section Text:</label>
                                    <textarea rows="5"
                                    class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"
                                        name="section_text" id="section_text" required>{!! old('section_text') ?? json_decode(json_decode($section)->content)->section_text !!}</textarea>

                                </div>
                                <span class="p-1 text-red-600">
                                    @error('section_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            {{--  section text ends here --}}
                        @endif


                        {{--  section button starts here  --}}
                        @if ($section->name == 'hero' || $section->name == 'about')
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full flex items-baseline space-x-1">
                                    <label class="font-medium" for="section_button_text">Section Button Text:</label>
                                    <input
                                        class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                        type="text" name="section_button_text" id="section_button_text"
                                        value="{{ old('section_button_text') ?? json_decode(json_decode($section)->content)->section_button_text }}"
                                        required>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('section_button_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full flex items-baseline space-x-1">
                                    <label class="font-medium" for="section_button_url">Section Button Url:</label>
                                    <input
                                        class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                        type="text" name="section_button_url" id="section_button_url"
                                        value="{{ old('section_button_url') ?? json_decode(json_decode($section)->content)->section_button_url }}"
                                        required>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('section_button_url')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        @endif
                        {{--  section button ends here --}}
                        @if ($section->name == 'why')
                            {{--  whys start here --}}
                            @foreach (json_decode(json_decode($section)->content)->whys as $key => $why)
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full flex items-baseline space-x-1">
                                        <label class="font-medium" for="why_title_{{ $key }}">Title:</label>
                                        <input
                                            class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                            type="text" name="why_title_{{ $key }}"
                                            id="why_title_{{ $key }}"
                                            value="{{ old('why_title_' . $key) ?? $why->title }}" required>
                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('why_title_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full grid grid-cols-1 gap-1">
                                        <label class="font-medium" for="why_text_{{ $key }}">Text:</label>
                                        
                                        <textarea rows="5" name="why_text_{{ $key }}" id="why_text_{{ $key }}"required
                                            class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">{!! old('why_text_' . $key) ?? $why->text !!}</textarea>
                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('why_text_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <label class="font-medium" for="">Icon:</label>
                                    <div
                                        class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                        <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">
                                            @foreach (listIcons() as $icon)
                                                <div
                                                    class="flex justify-center items-center space-x-1 @if ($why->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                    <input type="radio" @if ($why->icon == $icon) checked @endif
                                                        name="why_icon_{{ $key }}"
                                                        id="why_icon_{{ $loop->iteration }}"
                                                        value="{{ $icon }}">
                                                    <label class="font-medium"
                                                        for="why_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('why_icon_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endforeach
                            {{--  whys ends here --}}
                        @endif


                        @if ($section->name == 'how')
                            {{--  hows start here --}}
                            <h3 class="text-white font-bold">Step 1: Register</h3>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1 gap-1">
                                    <label class="font-medium" for="register_text">Register Text:</label>
                                    <textarea  rows="5"
                                        class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"
                                        name="register_text" id="register_text" required>{!! old('register_text') ?? json_decode(json_decode($section)->content)->steps->register->text !!} </textarea>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('register_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <label class="font-medium" for="">Register Icon:</label>
                                <div class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                    <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">
                                        @foreach (listIcons() as $icon)
                                            <div
                                                class="flex justify-center items-center space-x-1 @if (json_decode(json_decode($section)->content)->steps->register->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                <input type="radio" @if (json_decode(json_decode($section)->content)->steps->register->icon == $icon) checked @endif
                                                    name="register_icon" id="register_icon_{{ $loop->iteration }}"
                                                    value="{{ $icon }}">
                                                <label class="font-medium"
                                                    for="register_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <span class="p-1 text-red-600">
                                    @error('register_icon')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <h3 class="font-bold text-white">Step 2: Fund Wallet</h3>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1 gap-1">
                                    <label class="font-medium" for="fund_wallet_text">Fund Wallet Text:</label>
                                    <textarea  rows="5"
                                    class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"
                                        name="fund_wallet_text" id="fund_wallet_text" required>{!! old('fund_wallet_text') ?? json_decode(json_decode($section)->content)->steps->fund_wallet->text !!} </textarea>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('fund_wallet_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <label class="font-medium" for="">Fund Wallet Icon:</label>
                                <div class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                    <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">
                                        @foreach (listIcons() as $icon)
                                            <div
                                                class="flex justify-center items-center space-x-1 @if (json_decode(json_decode($section)->content)->steps->fund_wallet->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                <input type="radio" @if (json_decode(json_decode($section)->content)->steps->fund_wallet->icon == $icon) checked @endif
                                                    name="fund_wallet_icon" id="fund_wallet_icon_{{ $loop->iteration }}"
                                                    value="{{ $icon }}">
                                                <label class="font-medium"
                                                    for="fund_wallet_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('fund_wallet_icon')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <h3 class="font-bold text-white">Step 3: Invest</h3>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1 gap-1">
                                    <label class="font-medium" for="invest_text">Invest Text:</label>
                                    <textarea  rows="5"
                                    class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"
                                        name="invest_text" id="invest_text" required>{!! old('invest_text') ?? json_decode(json_decode($section)->content)->steps->invest->text !!} </textarea>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('invest_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <label class="font-medium" for="">Invest Icon:</label>
                                <div class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                    <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">
                                        @foreach (listIcons() as $icon)
                                            <div
                                                class="flex justify-center items-center space-x-1 @if (json_decode(json_decode($section)->content)->steps->invest->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                <input type="radio" @if (json_decode(json_decode($section)->content)->steps->invest->icon == $icon) checked @endif
                                                    name="invest_icon" id="invest_icon_{{ $loop->iteration }}"
                                                    value="{{ $icon }}">
                                                <label class="font-medium"
                                                    for="invest_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <span class="p-1 text-red-600">
                                    @error('invest_icon')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <h3 class="font-bold text-white">Step 4: Withdraw</h3>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1 gap-1">
                                    <label class="font-medium" for="withdraw_text">Withdraw Text:</label>
                                    <textarea  rows="5"
                                    class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"
                                        name="withdraw_text" id="withdraw_text" required>{!! old('withdraw_text') ?? json_decode(json_decode($section)->content)->steps->withdraw->text !!} </textarea>
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('withdraw_text')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <label class="font-medium" for="">Withdraw Icon:</label>
                                <div class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                    <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">

                                        @foreach (listIcons() as $icon)
                                            <div
                                                class="flex justify-center items-center space-x-1 @if (json_decode(json_decode($section)->content)->steps->withdraw->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                <input type="radio" @if (json_decode(json_decode($section)->content)->steps->withdraw->icon == $icon) checked @endif
                                                    name="withdraw_icon" id="withdraw_icon_{{ $loop->iteration }}"
                                                    value="{{ $icon }}">
                                                <label class="font-medium"
                                                    for="withdraw_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <span class="p-1 text-red-600">
                                    @error('withdraw_icon')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        @endif

                        @if ($section->name == 'stats')
                            {{--  counters start here --}}
                            @foreach (json_decode(json_decode($section)->content)->counters as $key => $counter)
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full flex items-baseline space-x-1">
                                        <label class="font-medium" for="counter_title_{{ $key }}">Title:</label>
                                        <input
                                            class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                            type="text" name="counter_title_{{ $key }}"
                                            id="counter_title_{{ $key }}"
                                            value="{{ old('counter_title_' . $key) ?? $counter->title }}" required>
                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('counter_title_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full flex items-baseline space-x-1">
                                        <label class="font-medium" for="counter_count_{{ $key }}">Count:</label>
                                        <input type="number" step="any"
                                            class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                            name="counter_count_{{ $key }}"
                                            id="counter_count_{{ $key }}"required
                                            value="{!! old('counter_count_' . $key) ?? $counter->count !!}">
                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('counter_count_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <label class="font-medium" for="">Icon:</label>
                                    <div
                                        class="h-60 overflow-y-scroll overflow-x-hidden bg-[#131d2c] rounded mb-2 mt-2 p-2">
                                        <div class="w-full grid grid-cols-3 md:grid-cols-4 gap-5 rounded">
                                            @foreach (listIcons() as $icon)
                                                <div
                                                    class="flex justify-center items-center space-x-1 @if ($counter->icon == $icon) bg-orange-500 text-white @else bg-gray-500 @endif ">
                                                    <input type="radio"
                                                        @if ($counter->icon == $icon) checked @endif
                                                        name="counter_icon_{{ $key }}"
                                                        id="counter_icon_{{ $loop->iteration }}"
                                                        value="{{ $icon }}">
                                                    <label class="font-medium"
                                                        for="why_icon_{{ $loop->iteration }}">{!! icon($icon, 16) !!}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    <span class="p-1 text-red-600">
                                        @error('counter_icon_{{ $key }}')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            @endforeach
                            {{--  counters ends here --}}
                        @endif

                        {{--  Section background image --}}
                        @if ($section->name == 'hero' || $section->name == 'breadcrumb' || $section->name == 'about')
                            <input type="hidden" name="old_section_bg_img" id=""
                                value="{{ json_decode(json_decode($section)->content)->section_bg_img }}">
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="w-full flex items-baseline space-x-1">
                                    <label class="font-medium" for="section_bg_img">Section Background Image:</label>
                                    <input
                                        class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                        type="file" accept="image/png, image/jpeg" name="section_bg_img"
                                        id="section_bg_img">
                                </div>

                                <span class="p-1 text-red-600">
                                    @error('section_bg_img')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        @endif

                        {{--  section bg image ends here --}}

                        {{--  Active Pages                   --}}
                        <h6 class="text-xs text-blue-400 mb-2">
                            Toggle the the pages you want this section to be active on.
                        </h6>
                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">

                                <label for="" class="font-medium">About Us:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="about"
                                        class="hidden-radio toggle @if (old('about') == 'enabled' || in_array('about', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="about" id="about"
                                        @if (old('about') == 'enabled' || in_array('about', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('about')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">
                                <label for="" class="font-medium">Blog:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="blog"
                                        class="hidden-radio toggle @if (old('blog') == 'enabled' || in_array('blog', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="blog" id="blog"
                                        @if (old('blog') == 'enabled' || in_array('blog', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('blog')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">
                                <label for="" class="font-medium">Blog Detail:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="blog_detail"
                                        class="hidden-radio toggle @if (old('blog_detail') == 'enabled' || in_array('blog_detail', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="blog_detail" id="blog_detail"
                                        @if (old('blog_detail') == 'enabled' || in_array('blog_detail', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('blog_detail')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">
                                <label for="" class="font-medium">Contact Us:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="contact"
                                        class="hidden-radio toggle @if (old('contact') == 'enabled' || in_array('contact', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="contact" id="contact"
                                        @if (old('contact') == 'enabled' || in_array('contact', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('contact')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">
                                <label for="" class="font-medium">Home Page:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="home"
                                        class="hidden-radio toggle @if (old('home') == 'enabled' || in_array('home', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="home" id="home"
                                        @if (old('home') == 'enabled' || in_array('home', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('home')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full md:w-1/2 flex justify-between items-center space-x-1">
                                <label for="" class="font-medium">Investment and Loan:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="plans"
                                        class="hidden-radio toggle @if (old('plans') == 'enabled' || in_array('plans', json_decode($section->pages))) toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="plans" id="plans"
                                        @if (old('plans') == 'enabled' || in_array('plans', json_decode($section->pages))) value="enabled" @else value="disabled" @endif
                                        required>

                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('plans')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{--  Active pages ends here --}}


                        <div class="w-full my-5 px-5">
                            <button type="submit"
                                class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save Changes
                            </button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#section_text'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
