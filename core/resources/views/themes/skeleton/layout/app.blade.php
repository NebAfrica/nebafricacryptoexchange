{{-- header  --}}
@include('themes.skeleton.includes.header')
{{-- end header --}}

<div>

    {{-- sidebar --}}
    @include('themes.skeleton.includes.sidenav')
    {{-- End sidebar --}}

    {{-- content --}}
    <div id="general-content">
        <div id="general-content-section">

            {{--  page heading - --}}
            @yield('title')
            {{--  heading ends here --}}

            {{--  action preloader --}}
            @include('preloaders.action')
            {{--  action preloader --}}

            {{--  notices --}}
            @include('themes.skeleton.includes.notice')
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
@include('themes.skeleton.includes.footer')
{{-- End footer --}}
