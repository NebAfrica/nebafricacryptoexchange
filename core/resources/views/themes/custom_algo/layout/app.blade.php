{{-- header  --}}
@include('themes.custom_algo.includes.header')
{{-- end header --}}

<div class="min-h-screen w-full md:flex">

    {{-- sidebar --}}
    @include('themes.custom_algo.includes.sidenav')
    {{-- End sidebar --}}

    {{-- content --}}
    <div class="pt-28 md:pt-0 mt-0 md:mt-36 w-full md:w-4/5" id="general-content">
        <div class="w-full md:w-10/12 md:ml-64 2xl:ml-1/5" id="general-content-section">

            {{--  page heading ---}}
            @yield('title')
            {{--  heading ends here --}}

            {{--  action preloader --}}
            @include('preloaders.action')
            {{--  action preloader --}}
            
            {{--  notices --}}
            @include('themes.custom_algo.includes.notice')
            {{--  notices --}}

            {{--  Infographic section --}}
            @yield('infographics')
            {{--  Infographic section ends here --}}

            {{--  Contents section --}}
            @yield('content')
            {{--  Contents section ends here --}}

        </div>
    </div>
    {{-- End Content --}}
</div>

{{-- footer --}}
@include('themes.custom_algo.includes.footer')
{{-- End footer --}}