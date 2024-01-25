{{-- If header component is necessary, it should begin here --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') | {{ websiteInfo('website_name') }}</title>
    <meta name="author" content="support@credcrypto.net">
    <meta name="author" content="support@credcrypto.net">
    <meta name="description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta name="keywords" content="{{ json_decode(websiteInfo('meta'))->keywords }}">
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="Crypto Trading">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="@yield('title') | {{ websiteInfo('website_name') }}">
    <meta property="og:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="og:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    {{-- Twitter ---}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="@yield('title') | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image"
        content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    <meta name="robots" content="noindex">


    {{-- Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">

    {{-- Styles --}}
    <link href="{{ asset('public/assets/themes/' . websiteInfo('theme') . '/style/bgs.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/' . websiteInfo('theme') . '/style/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/' . websiteInfo('theme') . '/style/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- Alpine js (deferred)  --}}
    <script defer src="{{ asset('public/assets/scripts/alpine3.js') }}"></script>

    {{--  Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    {{--  Sweet aler cdn --}}
    {{--  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Scripts CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

{{-- Please take note that in this and only this body tag, a class of overflow-y-hidden is present --}}


<body class="cred-hyip-theme1-bg w-screen h-screen overflow-y-hidden scrollbar">
{{--  preloader --}}
@include('preloaders.loading')
{{--  preloader --}}

<div class="w-full h-full px-5">
    <div class="flex justify-center w-full h-screen items-center">
        <div class="w-full md:w-3/4 lg:w-2/6 cred-hyip-theme1-primary-card">
            <div class="flex justify-center items-center">
                <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo" class="cred-hyip-theme1-card-logo">
            </div>
            <h3 class="text-xl text-center font-bold text-gray-300">
                @yield('code') | @yield('title')
            </h3>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-4">

            {{-- Forgot pass and regiater --}}
            <div class="text-gray-300 text-xs font-semibold mb-4 px-5 lg:px-10">
                <p class="mb-2">
                    @yield('message')
                    
                </p>
            </div>   
            
        </div>
    </div>
</div>


{{--  Live chat --}}
@if (websiteInfo('livechat') == 'enabled')
    {!! websiteInfo('livechat_script') !!}
@endif

{{--  whatsapp chat --}}
@if (json_decode(websiteInfo('whatsapp'))->status == 'enabled')
    @include('whatsapp')
@endif
{{--  whatsapp chat --}}

{{--  Sweet alert here --}}
@if (session()->has('fail'))
    <script>
        $(window).on('load', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: "{{ session()->get('fail') }}",
                showConfirmButton: false,
                timer: 4500,
                background: "#0e1726",
                color: "#b9bead",
                toast: true,
                
            })
        })
    </script>
@elseif (session()->has('success'))
    <script>
        $(window).on('load', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                text: "{{ session()->get('success') }}",
                showConfirmButton: false,
                timer: 4500,
                background: "#0e1726",
                color: "#b9bead",
                toast: true,
                
            })
        })
    </script>
@endif

{{--  preloader --}}
<script>
    $(document).ready(function() {
        window.onload = function() {
            $('#preloader').fadeOut(500, function() {
                $('#preloader').remove();
            });
        }
    });
</script>
{{--  preloader --}}

{{--  custom javascript --}}

{!! json_decode(websiteInfo('custom_js')) !!}

</body>

</html>
