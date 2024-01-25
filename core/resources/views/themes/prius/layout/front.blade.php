@php
    $countries = [
        'Afghanistan',
        'Albania',
        'Algeria',
        'American Samoa',
        'Andorra',
        'Angola',
        'Anguilla',
        'Antarctica',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Aruba',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bermuda',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegowina',
        'Botswana',
        'Bouvet Island',
        'Brazil',
        'British Indian Ocean Territory',
        'Brunei Darussalam',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Cape Verde',
        'Cayman Islands',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Christmas Island',
        'Cocos (Keeling) Islands',
        'Colombia',
        'Comoros',
        'Congo',
        'Congo, the Democratic Republic of the',
        'Cook Islands',
        'Costa Rica',
        "Cote d'Ivoire",
        'Croatia (Hrvatska)',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'East Timor',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Ethiopia',
        'Falkland Islands (Malvinas)',
        'Faroe Islands',
        'Fiji',
        'Finland',
        'France',
        'France Metropolitan',
        'French Guiana',
        'French Polynesia',
        'French Southern Territories',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Gibraltar',
        'Greece',
        'Greenland',
        'Grenada',
        'Guadeloupe',
        'Guam',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Heard and Mc Donald Islands',
        'Holy See (Vatican City State)',
        'Honduras',
        'Hong Kong',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran (Islamic Republic of)',
        'Iraq',
        'Ireland',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        "Korea, Democratic People's Republic of",
        'Korea, Republic of',
        'Kuwait',
        'Kyrgyzstan',
        "Lao, People's Democratic Republic",
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libyan Arab Jamahiriya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Macau',
        'Macedonia, The Former Yugoslav Republic of',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Martinique',
        'Mauritania',
        'Mauritius',
        'Mayotte',
        'Mexico',
        'Micronesia, Federated States of',
        'Moldova, Republic of',
        'Monaco',
        'Mongolia',
        'Montserrat',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'Netherlands Antilles',
        'New Caledonia',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'Niue',
        'Norfolk Island',
        'Northern Mariana Islands',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Pitcairn',
        'Poland',
        'Portugal',
        'Puerto Rico',
        'Qatar',
        'Reunion',
        'Romania',
        'Russian Federation',
        'Rwanda',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Vincent and the Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia (Slovak Republic)',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Georgia and the South Sandwich Islands',
        'Spain',
        'Sri Lanka',
        'St. Helena',
        'St. Pierre and Miquelon',
        'Sudan',
        'Suriname',
        'Svalbard and Jan Mayen Islands',
        'Swaziland',
        'Sweden',
        'Switzerland',
        'Syrian Arab Republic',
        'Taiwan, Province of China',
        'Tajikistan',
        'Tanzania, United Republic of',
        'Thailand',
        'Togo',
        'Tokelau',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Turks and Caicos Islands',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States',
        'United States Minor Outlying Islands',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Venezuela',
        'Vietnam',
        'Virgin Islands (British)',
        'Virgin Islands (U.S.)',
        'Wallis and Futuna Islands',
        'Western Sahara',
        'Yemen',
        'Yugoslavia',
        'Zambia',
        'Zimbabwe',
    ];
    
    shuffle($countries);
    $countries = array_slice($countries, 0, 100);
    $popups = [];
    
    foreach ($countries as $minute => $country) {
        $type = ['deposit', 'widthdrawal'][rand(0, 1)];
        if ($type == 'deposit') {
            $amount = rand(100, 20000);
        } else {
            $amount = rand(499, 59999);
        }
        array_push($popups, ' New ' . $type . ' from ' . $country . ' just now <br> <b>' . formatAmount($amount) . '</b> end');
    }
    
@endphp


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



    {{-- Google recaptcha --}}
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- Scripts CDN -->

    <!-- BootStrap Link -->
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/animate.css') }}">

    <!-- Icon Link -->
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/line-awesome.min.css') }}">

    <!-- Plugings Link -->
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/odometer.css') }}">

    <!-- Custom Link -->
    <link rel="stylesheet" href="{{ asset('public/assets/themes/prius/assets/css/main.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    @include('preloaders.loading')

    @yield('content')

    <!-- Footer Section Starts Here -->
    <footer class="footer-section section-bg">
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright text-center py-3">
                    Copyright &copy; {{ date('Y') }} {{ websiteInfo('website_name') }} | All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>
    <!-- Footer Section Ends Here -->


    <a href="#0" class="scrollToTop"><i class="las la-rocket"></i></a>
    <script src="{{ asset('public/assets/themes/prius/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/themes/prius/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/assets/themes/prius/assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('public/assets/themes/prius/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('public/assets/themes/prius/assets/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('public/assets/themes/prius/assets/js/main.js') }}"></script>

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
                            calc_result_max_amount +
                            " and {{ websiteInfo('general_currency') }}" +
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

        $(document).ready(function() {
            $('.coin-marquee-header-signature').html(
                '<a href="https://credcrypto.net" style="font-size: 10px" target="_blank" >Powered by <br> CredCrypto </a>'
            );
        });
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>

    <script>
        $(window).on('load', function() {
            $(".goog-logo-link").empty();
            $('.goog-te-gadget').html($('.goog-te-gadget').children());
            $('#preloader').hide();
            setTimeout(function() {
                var popups = "{{ json_encode($popups) }}";
                popups = JSON.stringify(popups);
                popups = popups.replace('&quot;', '').replace('[', '').replace(']', '').split(
                    'end&quot;,&quot;');
                var popup = popups[Math.floor(Math.random() * 20)];
                popup = popup.replace('&lt;br&gt; &lt;b&gt;', '<br> <b>').replace('&lt;/b&gt;', '</b>');
                Swal.fire({
                    position: 'top-start',
                    //icon: 'success',
                    html: popup,
                    showConfirmButton: false,
                    timer: 7000,
                    background: "#D7A31F",
                    color: "#0e1726",
                    toast: true,

                });
            }, 2000);


            setInterval(function() {
                var popups = "{{ json_encode($popups) }}";
                popups = JSON.stringify(popups);
                popups = popups.replace('&quot;', '').replace('[', '').replace(']', '').split(
                    'end&quot;,&quot;');
                var popup = popups[Math.floor(Math.random() * 100)];
                popup = popup.replace('&lt;br&gt; &lt;b&gt;', '<br> <b>').replace('&lt;/b&gt;', '</b>');
                Swal.fire({
                    position: 'top-start',
                    //icon: 'success',
                    html: popup,
                    showConfirmButton: false,
                    timer: 7000,
                    background: "#D7A31F",
                    color: "#0e1726",
                    toast: true,

                })
            }, 60000);

        })
    </script>

    @yield('script')

    {{-- whatsapp chat --}}
    @if (json_decode(websiteInfo('whatsapp'))->status == 'enabled')
        @include('whatsapp')
    @endif
    {{-- whatsapp chat --}}
    {{-- custom javascript --}}

    {!! json_decode(websiteInfo('custom_js')) !!}

    {{-- Live chat --}}
    @if (websiteInfo('livechat') == 'enabled')
        {!! websiteInfo('livechat_script') !!}
    @endif

</body>


</html>
