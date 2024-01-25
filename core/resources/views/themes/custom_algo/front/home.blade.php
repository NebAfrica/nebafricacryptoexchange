<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ ct($page_title, 'c') }} | {{ websiteInfo('website_name') }}</title>
    <meta name="author" content="support@credcrypto.net">
    <meta name="author" content="support@credcrypto.net">
    <meta name="description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta name="keywords" content="{{ json_decode(websiteInfo('meta'))->keywords }}">
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="Crypto Trading">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="og:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="og:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    {{-- Twitter - --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image"
        content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    <meta name="robots" content="{{ json_decode(websiteInfo('meta'))->robots }}">


    {{-- Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">


    <link href="{{ asset('public/assets/themes/custom_algo/assets/output.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/custom_algo/style/bgs.css') }}" rel="stylesheet">


    {{-- Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        .w-20 {
            width: 5rem;
        }

        .hero-img {
            -webkit-animation: mover 2s infinite alternate;
            animation: mover 2s infinite alternate;
        }

        @-webkit-keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>


<body>
    {{-- preloader --}}
    @include('preloaders.loading')
    {{-- preloader --}}
    <div class="bg-[#0e1726] text-white w-full h-full m-0 p-0">
        <!-- Nav Bar -->
        <div class="bg-[#0e1726] w-full pr-3 pl-1 lg:pr-4 lg:pl-4 flex justify-between items-center z-40 sticky top-0">
            <div class="lg:flex lg:space-x-5 lg:items-center">
                <!-- Logo -->
                <div>
                    <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}"
                        alt="logo">
                </div>

                <nav class="hidden lg:block">
                    <ul class="flex items-center space-x-4 text-lg text-gray-300">
                        <li class="transition-colors hover:text-white"><a href="#hero">Home</a></li>
                        <li class="transition-colors hover:text-white"><a href="#why">Why Choose Us</a></li>
                        <li class="transition-colors hover:text-white"><a href="#how">How it Works</a></li>
                        <li class="transition-colors hover:text-white"><a href="#contact">Contact Us</a></li>

                    </ul>
                </nav>
            </div>

            <div class="hidden lg:flex items-center space-x-7">
                @if (session()->has('loginId'))
                    <a href="{{ route('user.dashboard') }}"
                        class="h-11 px-8 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-lg text-gray-300 hover:text-white transition-colors">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="h-11 px-8 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                        <span>Sign up</span>
                    </a>
                @endif
            </div>

            <!-- Droptown toggle -->
            <div class="lg:hidden">
                <svg onclick="openNav()" class="w-8 h-8 md:w-16 md:h-16 cursor-pointer" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </div>

            <!-- Mobile menu -->
            <div id="mySidenav"
                class="bg-[#111f35] w-2/3 top-0 fixed right-0 h-screen p-5 z-40 hidden shadow-md transition ease-in-out duration-500">

                <!-- Nav close icon -->
                <div class="flex items-start w-full">
                    <div>
                        <svg onclick="closeNav()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <nav class="mt-8">
                    <div class="flex items-center space-x-7">
                        @if (session()->has('loginId'))
                            <a href="{{ route('user.dashboard') }}"
                                class="h-11 px-8 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                                <span>Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-lg text-gray-300 hover:text-white transition-colors">Log in</a>
                            <a href="{{ route('register') }}"
                                class="h-11 px-8 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                                <span>Sign up</span>
                            </a>
                        @endif
                    </div>
                    <ul class="mt-8 text-lg text-gray-300 font-semibold space-y-5">
                        <li class="transition-colors hover:text-white">
                            <a class="flex space-x-3 items-center" href="#hero" onclick="closeNav()">
                                <h5>
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </h5>
                                <h5>
                                    Home
                                </h5>
                            </a>
                        </li>
                        <li class="transition-colors hover:text-white">
                            <a class="flex space-x-3 items-center" href="#why" onclick="closeNav()">
                                <h5>
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </h5>
                                <h5>
                                    Why Choose Us
                                </h5>
                            </a>
                        </li>
                        <li class="transition-colors hover:text-white">
                            <a class="flex space-x-3 items-center" href="#how" onclick="closeNav()">
                                <h5>
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </h5>
                                <h5>
                                    How it Works
                                </h5>
                            </a>
                        </li>
                        <li class="transition-colors hover:text-white">
                            <a class="flex space-x-3 items-center" href="#contact" onclick="closeNav()">  
                                <h5>
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </h5>
                                <h5>
                                    Contact Us
                                </h5>
                            </a>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>

        {{-- Hero section --}}
        @foreach ($view_data['sections']->where('name', 'hero') as $section)
            <section id="hero">
                <div class="w-full grid grid-cols-2">
                    <div class="pl-3 lg:pl-16 lg:pr-6">
                        <h1 class="mt-32 capitalize text-4xl lg:text-7xl font-medium">
                            {!! json_decode($section->content)->section_heading !!}
                        </h1>

                        <div class="mt-10 text-lg font-medium">
                            {!! json_decode($section->content)->section_text !!}
                        </div>

                        <div class="mt-16 mb-24">
                            <a href="{{ json_decode($section->content)->section_button_url }}"
                                class="h-12 w-36 px-8 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                                {{ json_decode($section->content)->section_button_text }}
                            </a>
                        </div>
                    </div>
                    <div class="hero-img hidden lg:block h-full w-full overflow-hidden">
                        <img src="{{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }}"
                            alt="hero" class="lg:object-contain">
                    </div>
                    <div class="hero-img lg:hidden w-full  bg-cover bg-no-repeat"
                        style="background: url({{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }})">
                    </div>
                </div>
            </section>
        @endforeach

        {{-- stats --}}
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
            <section>
                <div class="mt-3 w-full grid grid-cols-1 lg:grid-cols-3 gap-3 lg:space-x-3 px-4 lg:px-16">
                    @foreach (json_decode($section->content)->counters as $counter)
                        <div class="w-full flex justify-center items-center bg-[#111f35] rounded p-5">
                            <div class="w-full flex justify-between items-center">
                                <div class="text-orange-500">
                                    {!! icon($counter->icon, 10) !!}
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold">{{ shortNumber($counter->count) }}</h4>
                                    <p class="mt-1 text-gray-400 font-medium">
                                        {!! $counter->title !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach



        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container mt-5">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                {
                    "symbols": [{
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "US 100"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "Bitcoin"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "Ethereum"
                        }
                    ],
                    "showSymbolLogo": true,
                    "colorTheme": "dark",
                    "isTransparent": true,
                    "displayMode": "adaptive",
                    "locale": "en"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->


        {{-- why --}}
        @foreach ($view_data['sections']->where('name', 'why') as $section)
            <section id="why">
                <div
                    class="bg-[#111f35] mt-12 w-full grid grid-cols-1 lg:grid-cols-2 lg:space-x-20 px-8 lg:px-16 py-20">
                    <div class="self-center">
                        <img src="{{ asset('public/assets/themes/custom_algo/assets/imgs/buy_sell.png') }}"
                            alt="Buy and sell">
                    </div>
                    <div class="mt-10 lg:mt-0">
                        <h3 class="text-2xl lg:text-4xl font-bold">{!! json_decode($section->content)->section_heading !!}</h3>
                        <div class="mt-3 text-base lg:text-lg font-medium text-gray-400">
                            {!! json_decode($section->content)->section_text !!}
                        </div>

                        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-9 lg:gap-5">
                            @foreach (json_decode($section->content)->whys as $why)
                                <div>
                                    <div class="text-orange-500">
                                        {!! icon($why->icon, 10) !!}
                                    </div>
                                    <h3 class="text-lg font-bold">{!! $why->title !!}</h3>
                                    <p class="mt-3 font-medium text-gray-400">
                                        {!! $why->text !!}
                                    </p>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endforeach


        <!-- Crypto list section -->
        <section>
            <div class="mt-7 lg:mt-12 w-full px-8 lg:px-16 pt-20">
                <h3 class="text-2xl lg:text-4xl font-bold">Trade, Invest & Earn Crypto</h3>
                <p class="mt-3 text-base lg:text-lg font-medium text-gray-400">
                    Choose from the top cryptocurrency assets on the UK's No. 1 platform
                </p>
            </div>
            <div class="mt-10 grid grid-cols-5 lg:grid-cols-7 gap-5 px-8 lg:px-16">

                @foreach (['btc', 'eth', 'ltc', 'doge', 'trx', 'ada', 'xrp', 'bnb', 'usdc', 'usdt', 'matic', 'dai', 'sol', 'atom'] as $image)
                    <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . $image . '.svg') }}" loading="lazy"
                        alt="{{ $image . ' logo' }}" class="w-20 cursor-pointer hover:rotate-90 transition-all">
                @endforeach

            </div>
            <div class="mt-16 pl-8 lg:pl-16 pb-10 lg:pb-20">
                <a href="{{ route('login') }}"
                    class="h-12 w-36 px-8 flex justify-center items-center bg-blue-500 rounded-lg transition-all hover:shadow-md hover:bg-blue-600 tracking-tight whitespace-nowrap">
                    Sign Up
                </a>
            </div>
        </section>


        {{-- how section here --}}
        @foreach ($view_data['sections']->where('name', 'how') as $section)
            <section id="how">
                <div class="bg-[#111f35] mt-12 w-full px-8 lg:px-16 pt-20">
                    <div class="lg:pt-32">
                        <h1 class="capitalize text-2xl lg:text-4xl font-bold">{!! json_decode($section->content)->section_heading !!}</h1>
                        <div class="mt-3 text-base lg:text-lg font-medium text-gray-400">
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>

                    <div class="mt-10 pb-20 grid grid-cols-1 lg:grid-cols-2 gap-3 lg:gap-5">
                        @foreach (json_decode($section->content)->steps as $step_name => $step)
                            <div class="w-full lg:w-[30rem] h-52 bg-[#0e1726] text-white rounded-lg p-5">
                                <div class="flex space-x-5 items-center">
                                    <div class="text-orange-500">
                                        {!! icon($step->icon, 10) !!}
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold">{!! ucwords(str_replace('_', ' ', $step_name)) !!}</h4>
                                        <div class="mt-6 pr-5">
                                            <p>{!! $step->text !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach


        <!-- Trading Device -->
        <section>
            <div class="mt-12 w-full px-8 lg:px-16 pt-20">
                <div class="lg:pt-32">
                    <h1 class="capitalize text-2xl lg:text-4xl font-bold">Trade crypto from anywhere</h1>
                    <p class="mt-3 text-base lg:text-lg font-medium text-gray-400">
                        Be on top of the crypto markets with {{ websiteInfo('website_name') }} Mobile app for Android
                        or iOS.
                    </p>
                </div>
            </div>
            <div class="w-full px-8 lg:px-16">
                <img src="{{ asset('public/assets/themes/custom_algo/assets/imgs/full.png') }}"
                    alt="Trading page screenshot">
            </div>
            <div class="mt-10 lg:mt-16 pl-8 lg:pl-16 pb-10 lg:pb-20">
                <a href="{{ route('register') }}"
                    class="h-12 w-40 px-4 flex justify-center items-center bg-orange-500 rounded-lg transition-all hover:shadow-md hover:bg-orange-600">
                    Signup & Trade
                </a>
            </div>
        </section>




        <!-- ########### I ran out of options of what should be here. But i'm thinking a trading widget might go well here -->
        <!-- TradingView Widget BEGIN -->
        <div class="lg:mt-12 h-[35rem] lg:h-[42rem] w-full lg:px-16 py-20">
            <div class="tradingview-widget-container w-full h-full">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                    {
                        "width": "100%",
                        "height": "100%",
                        "defaultColumn": "overview",
                        "screener_type": "crypto_mkt",
                        "displayCurrency": "USD",
                        "colorTheme": "dark",
                        "locale": "en",
                        "isTransparent": true
                    }
                </script>
            </div>
        </div>
        <!-- TradingView Widget END -->



        {{-- contact --}}
        @foreach ($view_data['sections']->where('name', 'contact') as $section)
            <section id="contact">
                <div class="bg-[#111f35] lg:mt-12 w-full px-8 lg:px-16 py-20">
                    <div class="pt-12 lg:pt-32">
                        <h1 class="capitalize text-4xl font-bold">{!! json_decode($section->content)->section_heading !!}</h1>
                        <div class="mt-3 text-lg font-medium text-gray-400">
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>

                    <div class="mt-10 w-full lg:flex lg:justify-evenly lg:items-center">
                        <div class="w-full lg:w-1/2 flex flex-col space-y-3">
                            <div class="flex space-x-2 items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl text-gray-400">{{ websiteInfo('website_phone_no') }}</h4>
                                </div>
                            </div>
                            <div class="flex space-x-2 items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl text-gray-400">{{ websiteInfo('website_email') }}</h4>
                                </div>
                            </div>

                            <div class="flex space-x-2 items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xl text-gray-400">
                                        {!! websiteInfo('website_contact_address') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-10 lg:mt-0 w-full lg:w-1/2 p-4 lg:p-8 border-4 border-orange-500 rounded-2xl flex justify-center bg-[#0e1726]">
                            <form action="{{ route('contact-validate') }}" class="w-full lg:w-10/12" method="POST">
                                <div class="w-full my-3">
                                    <input type="text" name="name" value="{{ old('name') }}" id=""
                                        placeholder="Name:"
                                        class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                                    <div>
                                        <span class="text-red-500">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full my-3">
                                    <input type="email" name="email" id="" placeholder="Email:"
                                        class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                                    <div>
                                        <span class="text-red-500">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full my-3">
                                    <input type="text" name="subject" id="" placeholder="Subject:"
                                        class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                                    <div>
                                        <span class="text-red-500">
                                            @error('subject')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full my-3">
                                    <textarea rows="5" name="message" id="" placeholder="Message:"
                                        class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none"></textarea>
                                    <div>
                                        <span class="text-red-500">
                                            @error('message')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                @if (websiteInfo('google_captcha') == 'enabled')
                                    <div class="w-full my-3 grid grid-cols-1">
                                        <div class="relative">
                                            {!! htmlFormSnippet() !!}
                                            <span>
                                                @error('g-recaptcha-response')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="w-full my-3">
                                    <button
                                        type="submit"class="uppercase h-12 w-36 px-8 flex justify-center items-center bg-blue-500 rounded-lg transition-all hover:shadow-md hover:bg-blue-600">
                                        submit
                                        </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach



        <div class="mt-12 w-full text-gray-500 text-sm 2xl:text-2xl font-semibold px-8 lg:px-16 py-8 2xl:pt-20">
            <div align="center">
                &copy; <?php echo date('Y '); ?> {{ websiteInfo('website_name') }} | All Rights Reserved
            </div>

            <hr class="w-full my-5 border-gray-700">

            @foreach ($view_data['sections']->where('name', 'about') as $section)
                <div class="text-xs font-normal">
                    {!! json_decode($section->content)->section_text !!}
                </div>
            @endforeach
        </div>
    </div>


    <script>
        function openNav() {
            document.getElementById("mySidenav").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.display = "none";
        }
    </script>

    {{-- whatsapp chat --}}
    @if (json_decode(websiteInfo('whatsapp'))->status == 'enabled')
        @include('whatsapp')
    @endif
    {{-- whatsapp chat --}}

    {{-- mobile menu --}}
    @include('themes.cryptic.includes.front.mobile-menu')


    {{-- preloader --}}
    <script>
        $(document).ready(function() {
            window.onload = function() {
                $('#preloader').fadeOut(500, function() {
                    $('#preloader').remove();
                });
            }
        });
    </script>
    {{-- preloader --}}

    {{-- custom javascript --}}

    {!! json_decode(websiteInfo('custom_js')) !!}

    {{-- Live chat --}}
    @if (websiteInfo('livechat') == 'enabled')
        {!! websiteInfo('livechat_script') !!}
    @endif
</body>

</html>
