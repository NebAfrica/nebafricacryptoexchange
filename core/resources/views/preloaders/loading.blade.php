<div id="preloader" class="loading-preloader">
    <div id="particles-background" class="vertical-centered-box"></div>
    <div id="particles-foreground" class="vertical-centered-box"></div>

    <div class="background">
        @for ($i = 0; $i < 0; $i++)
            <span></span>
        @endfor
    </div>

    <div class="vertical-centered-box">
    <div class="content loader-image">
        <div class="loader-circle"></div>
        <div class="loader-line-mask">
        <div class="loader-line"></div>
        </div>
        <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="logo">
    </div>
    </div>
</div>


