{{-- If header component is necessary, it should begin here --}}
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

    {{-- main js  --}}
    <script src="{{ asset('public/assets/scripts/main.js') }}"></script>

</head>

{{-- Please take note that in this and only this body tag, a class of overflow-y-hidden is present --}}


@if (request()->is('register'))

    <body class="cred-hyip-theme1-bg w-full h-full scrollbar">
    @else

        <body class="cred-hyip-theme1-bg w-screen h-screen overflow-y-hidden scrollbar">
@endif



{{--  preloader --}}
@include('preloaders.loading')
{{--  preloader --}}



{{-- Header conponent end  --}}


@yield('content')
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

<script>
    $('.resend-otp').on('click', function(e) {
        e.preventDefault();
        var clicked = $(this);
        $('#preloader').show();
        $.ajax({
            url: "{{ route('resend-otp') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#preloader').hide();
                var timeleft = 60;
                var timer = setInterval(function() {
                    if (timeleft <= 0) {
                        clearInterval(timer);
                        clicked.html('Resend Otp');

                    } else {
                        clicked.html('<span class="text-red-500">Resend Otp in: ' +
                            timeleft + '</span>');
                    }
                    timeleft -= 1;
                }, 1000);

                clicked.css({
                    'pointer-events': 'none',
                });
                setTimeout(function() {
                    clicked.css({
                        'pointer-events': 'auto'
                    });
                    clicked.html('Resend Otp');
                }, 60000);

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'OTP has been resent',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,

                });

            },
            error: function(response) {
                $('#preloader').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: 'Failed to resend otp',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,

                });

            },
        });
    });
</script>

{{--  custom javascript --}}

{!! json_decode(websiteInfo('custom_js')) !!}

</body>

</html>
