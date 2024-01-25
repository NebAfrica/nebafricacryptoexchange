{{-- If header component is necessary, it should begin here --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>{{ $page_title }} | CredCrypto</title>


    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    {{-- Twitter --}}
    <meta property="twitter:card" content="">
    <meta property="twitter:url" content="">
    <meta property="twitter:title" content="">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/favicon.png') }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">

    {{-- Styles --}}
    <link href="{{ asset('public/assets/themes/cryptic/style/bgs.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/cryptic/style/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/cryptic/style/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    {{--  Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    {{-- Scripts CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{--  Sweet aler cdn --}}
    {{--  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-[#f5f6fa]">


    {{-- preloader --}}
    @include('preloaders.action')

    {{-- Header conponent end --}}


    @yield('content')


    <script>
        $(document).ready(function(){
            $('#preloader').hide();
            $('.trigger').on('click', function(){
                $('#preloader').show();
            })
        })
    </script>
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
                toast: true,
                background: "#0e1726",
                color: "#b9bead",
                
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
</body>

</html>