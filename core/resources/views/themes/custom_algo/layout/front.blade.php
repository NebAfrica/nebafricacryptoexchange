<?php
    header('Location: /');
    exit;
?>

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



    {{-- owl carousel --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('public/assets/themes/cryptic/style/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/themes/cryptic/style/bgs.css') }}" rel="stylesheet">

    {{-- aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- Scripts CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>


    {{-- owl carousel --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="h-screen w-screen top-0 left-0 fixed z-0" id="particles-js"></div>

    {{-- preloader --}}
    @include('preloaders.loading')
    {{-- preloader --}}
    @yield('content')

    <footer class="hero-section bg-[#0e1726] text-white border-t-1">
        <div class="">
            <div class="flex justify-center items-center pt-8 pb-10 ">
                <div class="font-semibold text-sm">
                    &copy; {{ date('Y ') . websiteInfo('website_name') }} | All Rigght Reserved
                </div>

            </div>
        </div>



        @yield('script')

        {{-- whatsapp chat --}}
        @if (json_decode(websiteInfo('whatsapp'))->status == 'enabled')
            @include('whatsapp')
        @endif
        {{-- whatsapp chat --}}

        {{-- mobile menu --}}
        @include('themes.custom_algo.includes.front.mobile-menu')


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



        {{-- custom svg sizing --}}
        <script>
            $(document).ready(function() {

                $(".custom-svg").children().removeClass('w-6 h-6').addClass('w-14 h-14 text-orange-500');
                $(".custom-svg-20").children().removeClass('w-6 h-6').addClass('w-20 h-20 text-orange-500');
            });
        </script>

        {{-- calculate profit --}}
        <script>
            $(document).ready(function() {
                //disable amount field
                $("#calc_plan_amount").prop('readonly', true);
                $("#cal_submit_button").on('click', function(e) {
                    e.preventDefault();
                });
                $("#cal_plan").on('change', function() {
                    $('#result-wrapper').removeClass('hidden');
                    var calc_result_name = $("#cal_plan").val();
                    var calc_result_amount_type = $("#cal_plan").find(':selected').data('amount_type');
                    var calc_result_min_amount = $("#cal_plan").find(':selected').data('min_amount');
                    var calc_result_max_amount = $("#cal_plan").find(':selected').data('max_amount');
                    var calc_result_return = $("#cal_plan").find(':selected').data('return');
                    var calc_result_return_type = $("#cal_plan").find(':selected').data('return_type');
                    var calc_result_duration = $("#cal_plan").find(':selected').data('duration');
                    var calc_result_duration_type = $("#cal_plan").find(':selected').data('duration_type');

                    //show selected plan details to the user
                    $("#calc_result_name").html(calc_result_name);
                    $("#calc_result_min_amount").html("{{ websiteInfo('general_currency') }}" +
                        calc_result_min_amount);

                    $("#calc_result_return_type").html(calc_result_return_type);
                    $("#calc_result_duration").html(calc_result_duration);
                    $("#calc_result_duration_type").html(calc_result_duration_type);
                    if (calc_result_amount_type === 'range') {
                        $("#calc_result_max_amount").html(' - ' + " {{ websiteInfo('general_currency') }}" +
                            calc_result_max_amount);
                    }

                    //hide error and results
                    $("#errorDiv").html('');
                    $("#final_result").html('');

                    //check return type 
                    if (calc_result_return_type === 'fixed') {
                        $("#calc_result_return").html("{{ websiteInfo('general_currency') }}" +
                            calc_result_return);
                    } else {
                        $("#calc_result_return").html(calc_result_return + "%");
                    }

                    $('#calc_result').show();



                    //for fixed plan, set amount value and make it ready only
                    if (calc_result_amount_type === 'fixed') {
                        $("#calc_plan_amount").val(calc_result_max_amount).prop('readonly', true);
                        var start_calculation = true;
                    } else {
                        //remove readonly
                        $("#calc_plan_amount").prop('readonly', false).val('');
                        //set min and max
                        $("#calc_plan_amount").attr({
                            'max': calc_result_max_amount,
                            'min': calc_result_min_amount,
                        });

                    }

                    $("#cal_submit_button").on('click', function(e) {
                        //check if the min and max followed                        
                        var calc_entered_amount = $("#calc_plan_amount").val();
                        if (calc_entered_amount > calc_result_max_amount || calc_entered_amount <
                            calc_result_min_amount) {
                            var start_calculation = false;
                            var error_message =
                                "Maximum and minumum amount for selected plan is {{ websiteInfo('general_currency') }}" +
                                calc_result_max_amount + " and {{ websiteInfo('general_currency') }}" +
                                calc_result_min_amount + " respectively";
                        } else {
                            var start_calculation = true;
                        }

                        $('#result-wrapper').removeClass('hidden');
                        if (start_calculation === false) {
                            $("#errorDiv").html(error_message);
                            $("#final_result").html('');

                        } else {
                            //calculate profit
                            if (calc_result_return_type === 'fixed') {
                                let result = +calc_entered_amount + +calc_result_return;
                                $('#calc_result').show();
                                $('#final_result').html(
                                    'You will earn {{ websiteInfo('general_currency') }}' +
                                    result + ' after ' + calc_result_duration +
                                    calc_result_duration_type + '(s)');
                            } else {
                                let calculated = calc_result_return / 100 * calc_entered_amount;
                                let result = +calc_entered_amount + +calculated;
                                $("#errorDiv").html('');
                                $('#final_result').html(
                                    'You will earn {{ websiteInfo('general_currency') }}' +
                                    result + ' after ' + calc_result_duration +
                                    calc_result_duration_type + '(s)');
                            }

                            setTimeout(function() {
                                $('#result-wrapper').addClass('hidden');
                            }, 5000);
                        }

                    })
                });


            });
        </script>
        {{-- particle js --}}
        <script src="{{ asset('public/assets/scripts/particle.js') }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset('public/assets/scripts/particlejs-config.json') }}', function() {
                // add z-index to all clickable elements
                $('a').addClass('z-20');
            });
        </script>


        {{-- aos --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>
        <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
            </script>

    </footer>



</body>

</html>
