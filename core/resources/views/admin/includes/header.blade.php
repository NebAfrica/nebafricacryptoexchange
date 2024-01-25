@php
    use Illuminate\Support\Carbon;
@endphp

<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $page_title }} | {{ websiteInfo('website_name') }}</title>
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
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image"
        content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    <meta name="robots" content="noindex">
    <meta name="robots" content="none">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">

    {{-- Styles --}}
    {{-- primary style --}}
    <link href="{{ asset('public/assets/themes/cryptic/style/styles.css?v2.0.4') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/themes/' . websiteInfo('theme') . '/style/bgs.css') }}" rel="stylesheet"
        type="text/css">
    {{-- google material icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/scroller/2.0.7/css/scroller.dataTables.min.css">
    {{-- owl carousel --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        /* Custom CSS */
            {
             ! ! json_decode(websiteInfo('custom_css')) ! !
        }
    </style>
    {{-- End Styles --}}

    {{-- Scripts CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{--  google captcah --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    {{--  Sweet alert cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{--  Owl carousel cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--  classic editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    {{-- Chart js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--  code mirror --}}

    <link href="{{ asset('public/codemirror/lib/codemirror.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/codemirror/theme/cobalt.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="cred-hyip-theme1-bg">
    <div class="fixed w-full z-20">
        {{-- Begin nav --}}
        <div class="flex justify-between w-full py-1 md:py-3 pl-4 md:pl-8 pr-3 md:pr-5 cred-hyip-theme1-bg">
            <div class="flex justify-start space-x-12 w-1/2 items-center">
                {{-- logo --}}
                <div class="">
                    <a href="#">
                        <img class="rounded-sm w-8 md:w-16"
                            src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}"
                            alt="">
                    </a>
                </div>



                <div
                    class="hidden md:flex justify-between items-center pr-5 text-gray-600 focus-within:text-gray-400 w-full">
                    <input type="text" value="Last Cron Job: {{ formatPastDate(websiteInfo('cron')) }}"
                        class="h-10 w-full @if (websiteInfo('cron') < Carbon::now()->addMinutes(-15)->timestamp) text-red-500 @else text-green-500 @endif font-medium px-4 rounded-md overflow-x-hidden border-0 bg-gray-800 outline-gray-800 ring-gray-800"
                        disabled>

                </div>
            </div>

            <div class="flex justify-end w-1/2 space-x-4 items-center">

                <div class="hidden md:block" id="google_translate_element"></div>

                {{-- user photo --}}
                <div>
                    <a class="dropdown" href="#">
                        <img class="rounded-full w-8 md:w-10"
                            src="{{ asset(route('file', ['admin', admin('profile_photo')])) }}" alt="">
                    </a>
                    <ul class="dropdown-menu z-20 absolute w-48 right-0 hidden text-gray-400 text-sm pt-1">
                        <li class=""><a
                                class="rounded-t cred-hyip-theme1-bg2 hover:text-gray-200 py-2 px-4 block whitespace-nowrap"
                                href="#">{{ admin('first_name') . ' ' . admin('last_name') }}</a></li>
                        <li class=""><a
                                class="cred-hyip-theme1-bg2 hover:text-gray-200 py-2 px-4 block whitespace-nowrap"
                                href="{{ route('admin.account.profile') }}">Account Setitng</a></li>
                        <li class=""><a
                                class="rounded-b cred-hyip-theme1-bg2 hover:text-gray-200 py-2 px-4 block whitespace-nowrap"
                                href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- End nav --}}

        <div class="cred-hyip-theme1-breadcrumb">
            <div class="flex items-center space-x-1 md:space-x-3">
                <div class="sidebar-toggle-btn text-white cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>

                <div class="text-xs md:text-sm font-medium md:font-semibold text-white">
                    <a href="{{ route('admin.dashboard') }}"
                        class="cred-hyip-theme1-breadcrumb-item-nested">Dashboard</a>

                </div>
            </div>


            <div class="relative inline-block">
                {{-- Dropdown toggle button --}}
                <button
                    class="dropdown-with-caret relative sm:w-full z-10 flex items-center p-2 border border-gray-700 text-xs text-gray-300 font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:text-white focus:shadow-outline"
                    data-menu-id="1">
                    <span class="mx-1">Quick Links</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 the-caret" data-menu-id="1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Dropdown menu --}}
                <div class="dropdown-menu hidden absolute right-0 z-20 w-44 py-2 mt-2 overflow-hidden bg-white rounded-md shadow-xl dark:bg-gray-800 the-menu"
                    data-menu-id="1">

                    <a href="{{ route('index') }}"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Home
                    </a>

                    <a href="{{ route('about') }}"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        About Us
                    </a>

                    <a href="{{ route('contact') }}"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Contact Us
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="{{ route('blogs') }}"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Blog
                    </a>

                    <hr class="border-gray-200 dark:border-gray-700 ">

                    <a href="#"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        FAQ
                    </a>
                    <a href="#"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Privacy Policy
                    </a>
                    <a href="#"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Terms & Conditions
                    </a>
                </div>
            </div>
        </div>
    </div>
