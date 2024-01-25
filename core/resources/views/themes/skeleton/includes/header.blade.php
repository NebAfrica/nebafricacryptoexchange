<!Doctype html>
<html lang="en">

<head>
    {{-- Site Metas --}}
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
    <link href="{{ asset('public/assets/themes/' . websiteInfo('theme') . '/style/styles.css') }}" rel="stylesheet"
        type="text/css">
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
        {!! json_decode(websiteInfo('custom_css')) !!} #google_translate_element div span {
            display: none;
        }

        .funny-radio {
            appearance: none;
            border: 1px solid #d3d3d3;
            width: 1.25rem;
            height: 1.25rem;
            content: none;
            outline: none;
            margin: 0;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .funny-radio:checked {
            appearance: none;
            outline: none;
            padding: 0;
            content: none;
            border: none;
        }

        .funny-radio:checked::before {
            position: absolute;
            color: green !important;
            content: "\00A0\2713\00A0" !important;
            font-weight: bolder;
            font-size: 1rem;
        }

        .owl-nav {
            display: flex;
            justify-content: space-between;
        }

        .owl-nav button {
            background: transparent !important;
        }

        .owl-nav button.owl-prev span,
        .owl-nav button.owl-next span {
            font-size: 2rem;
            line-height: 1.75rem;
            font-weight: 700;
            color: white;
        }

        /* scrollbar */
        /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(96 125 139);
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(96 125 139);
        }

        .md\:ml-10 {
            margin-left: 2.5rem;
        }
    </style>
    {{-- End Styles --}}

    {{-- Scripts CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{--  google captcah --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    {{--  Sweet alert cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{--  Owl carousel cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Chart js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div>
        {{-- Begin nav --}}
        <div>
            <div>
                {{-- logo --}}
                <div>
                    <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}"
                        alt="">
                    </a>
                </div>

                <div>
                    @if (session()->has('login_as_user'))
                        <div>
                            <p>You are currently logged in as {{ user('first_name') }}
                                , <a href="{{ route('admin.users.admin-go-back') }}"><span>BACK TO ADMIN</span></a>
                            </p>

                        </div>
                    @endif
                </div>
            </div>

            <div>

                <div id="google_translate_element"></div>

                {{-- user photo --}}
                <div>
                    <a href="#">
                        <img src="{{ route('file', ['profile', user('profile_picture')]) }}" alt="">
                    </a>

                    @if (websiteInfo('id_verification') === 'enabled' && isAddonEnabled('kyc'))
                        <div>
                            @if (user('id_verified') == 'verified')
                                <h6>
                                </h6>
                            @elseif (user('id_verified') == 'admin_review')
                                <h6>
                                </h6>
                            @elseif (user('id_verified') == 'rejected')
                                <h6>
                                </h6>
                            @elseif (user('id_verified') == 'pending')
                                <h6>
                                </h6>
                            @endif
                        </div>
                    @endif

                    <ul>

                        <li>{{ user('first_name') . ' ' . user('last_name') }}
                            <br> [{{ user('account_id') }}]</span>
                        </li>
                        @if (websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc'))
                            <li href="{{ route('user.id.status') }}">KYC</a></li>
                        @endif
                        <li href="{{ route('user.account.profile') }}"> Profile Overview </a></li>
                        <li href="{{ route('user.account.edit') }}">Account Setting </a></li>
                        <li href="{{ route('user.logout') }}"> Logout </a></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- End nav --}}

        <div>
            <div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>

                <div>
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                </div>
            </div>


            <div>
                {{-- Dropdown toggle button --}}
                <button data-menu-id="1">
                    <span>Quick Links</span>
                    <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Dropdown menu --}}
                <div data-menu-id="1">

                    <a href="{{ route('index') }}">
                        Home
                    </a>

                    <a href="{{ route('about') }}">
                        About Us
                    </a>

                    <a href="{{ route('contact') }}">
                        Contact Us
                    </a>

                    <hr>

                    <a href="{{ route('blogs') }}">
                        Blog
                    </a>

                    <hr>

                    <a href="#">
                        FAQ
                    </a>
                    <a href="#">
                        Privacy Policy
                    </a>
                    <a href="#">
                        Terms & Conditions
                    </a>
                </div>
            </div>
        </div>
    </div>
