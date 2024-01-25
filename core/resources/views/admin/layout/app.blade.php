{{-- header --}}
@include('admin.includes.header')
{{-- end header --}}


<div class="min-h-screen w-full md:flex">

    {{-- sidebar --}}
    @include('admin.includes.sidenav')
    {{-- End sidebar --}}

    {{-- content --}}
    <div class="pt-28 md:pt-0 mt-0 md:mt-36 w-full md:w-4/5" id="general-content">
        <div class="w-full md:w-10/12 md:ml-64 2xl:ml-1/5" id="general-content-section">
            {{--  page heading --}}
            @yield('title')
            {{--  heading ends here --}}

            {{--  action loader --}}
            @include('preloaders.action')
            {{--  action loaderr --}}

            {{--  notices --}}
            @include('admin.includes.notice')
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
@include('admin.includes.footer')
{{-- End footer --}}