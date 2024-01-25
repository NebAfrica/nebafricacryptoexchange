<div class="mobile-menu w-2/3 bg-[#111f35] text-white top-0 fixed right-0 h-screen p-5 z-40 lg:hidden hidden">
    <span class="mobile-menu-trigger">
        <svg class="w-8 h-8 md:w-16 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
        </svg>
    </span>
    <div class="w-full flex flex-col items-center">
        <ul class="w-full flex flex-col justify-center items-center">
            <li
                class="uppercase text-lg sm-font-3 mb-3 font-bold @if (request()->routeIs('index')) text-orange-500 @endif">
                <a href="/">home</a></li>
            <li
                class="uppercase text-lg sm-font-3 mb-3 font-bold @if (request()->routeIs('about')) text-orange-500 @endif">
                <a href="{{ route('about') }}">about</a></li>
            <li
                class="uppercase text-lg sm-font-3 mb-3 font-bold @if (request()->routeIs('plan')) text-orange-500 @endif">
                <a href="{{ route('plans') }}">plan</a></li>
            <li
                class="uppercase text-lg sm-font-3 mb-3 font-bold @if (request()->routeIs('loan')) text-orange-500 @endif">
                <a href="{{ route('plans') }}">loan</a></li>
            <li
                class="uppercase text-lg sm-font-3 mb-3 font-bold @if (request()->routeIs('faq')) text-orange-500 @endif">
                <a href="{{ route('faq') }}">faq</a></li>
            <li
                class="uppercase text-lg sm-font-3 mb-3  font-bold @if (request()->routeIs('contact')) border-b-4 border-orange-600 @endif">
                <a href="{{ route('contact') }}">contact</a></li>
        </ul>

        <div class="mt-5">
            <a href="{{ route('login') }}"
                class="uppercase text-lg sm-font-3 font-bold rounded-full px-10 py-2 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">Login</a>
        </div>
    </div>
    
</div>


{{-- toggle mobile menu --}}
<script>
    $('.mobile-menu-trigger').on('click', function(){
        $('.mobile-menu').toggleClass('hidden');
    })
</script>