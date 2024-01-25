<!-- Header Section Starts Here -->
<div class="header">
    <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
    <div id="coinmarketcap-widget-marquee" coins="1,1027,825,2,74" currency="USD" theme="dark" transparent="true"
        show-symbol-logo="true"></div>

    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-area">
                <div class="logo"><a href="index.html"><img
                            src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}"
                            alt="logo"></a></div>
                <ul class="menu">
                    <li style="width: 100px; overflow:hidden;" class="d-flex align-items-center">
                        <div class="custom--scrollbar" id="google_translate_element"></div>

                    </li>
                    <li>
                        <a href="{{ url('/') }}">Home</a>

                    </li>
                    <li>
                        <a href="{{ route('about') }}">About</a>
                    </li>

                    <li>
                        <a href="{{ route('plans') }}">plan</a>
                    </li>
                    <li>
                        <a href="{{ route('plans') }}">loan</a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}">faq</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">contact</a>
                    </li>
                </ul> <!-- Menu End -->

                <div class="button__wrapper d-none d-lg-block">
                    <a href="{{ route('register') }}" class="cmn--btn">Register</a>
                    <a href="{{ route('login') }}" class="cmn--btn">Login</a>
                </div>
                <div class="header-trigger-wrapper d-flex d-lg-none align-items-center">
                    <div class="mobile-nav-right d-flex align-items-center"></div>
                    <div class="header-trigger d-block d--none">
                        <span></span>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<!-- Header Section Ends Here -->
