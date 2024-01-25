<!DOCTYPE html>
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
    <meta property="og:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner ) }}">
    {{-- Twitter ---}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner ) }}">
    <meta name="robots" content="{{ json_decode(websiteInfo('meta'))->robots }}">
    

    {{-- Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">


    {{--  Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    {{-- Scripts CDN --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
    <style>
        section {
            min-height: 500px;
        }
        .breadcrumb-section {
            height: 200px; 
            min-height: 200px;
            background-size: cover !important;
            background-position: center !important;
        }
    </style>
</head>
<body>
    {{--  preloader --}}
    @include('preloaders.loading')
    {{--  preloader --}}
    @yield('content')
    @yield('script')

    {{--  whatsapp chat --}}
    @if (json_decode(websiteInfo('whatsapp'))->status == 'enabled')
        @include('whatsapp')
    @endif
    {{--  whatsapp chat --}}

    {{--  preloader --}}
    <script>
        $(document).ready(function() {
            window.onload = function () {
                $('#preloader').fadeOut(500, function(){ 
                    $('#preloader').remove(); 
                } );
            }
        });
    </script>
    {{--  preloader --}}

    {{--  custom javascript --}}
    
    {!! json_decode(websiteInfo('custom_js')) !!}

    {{--  Live chat --}}
    @if (websiteInfo('livechat') == 'enabled')
    {!! websiteInfo('livechat_script') !!}
    @endif
    
</body>
</html>
