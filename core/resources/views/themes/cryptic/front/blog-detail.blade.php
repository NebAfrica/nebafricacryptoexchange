@extends('themes.cryptic.layout.front')


@section('content')
    {{-- breadcrumb --}}
    @include('themes.cryptic.includes.front.sections.breadcrumb')

    {{-- main blog container --}}
    <section class="w-full cred-hyip-theme1-bg p-2 md:p-10 text-[#d3d6df]">
        <div class="lg:flex lg:space-x-5 p-2 md:p-10  rounded-lg">
            <div class="content bg-[#131d2c] w-full lg:w-2/3 rounded-lg p-2 md:p-10 mb-5">
                <div class="mb-5">
                    <div class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                    </div>
                    <h1 class="capitalize text-6xl sm-font-6 font-bold">{{ $blog->title }}</h1>
                    <div class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                    </div>
                </div>
                <div class="bg-white flex justify-center items-center h-96 overflow-hidden rounded p-2">
                    <img class="w-full" src="{{ route('file', ['blogs', $blog->img]) }}" alt="{{ $blog->title }}"
                        title="{{ $blog->title }}">
                </div>
                <div class="meta w-full font-medium text-xs mt-5">
                    <div class="mb-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                    </div>
                    <div class="w-full flex space-x-2">
                        <div class="flex items-center space-x-1">
                            <span class="text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </span>
                            <p>
                                {{ $blog->author }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </span>
                            <p>
                                {{ $blog->category }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                            <p>
                                {{ formatPastDate(strtotime($blog->created_at)) }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                    </div>
                </div>
                <div class="post mt-5 mb-5">
                    {!! $blog->detail !!}
                </div>
            </div>
            <div class="sidebar bg-[#0e1726] w-full lg:w-1/3 rounded-lg p-2 md:p-10 mb-5">
                @foreach ($view_data['blogs']->where('id', '!=', $blog->id) as $more)
                    <div class="w-full bg-[#131d2c] mb-4 p-2">
                        <div class="bg-white flex justify-center items-center h-40 overflow-hidden rounded">
                            @if ($more->type == 'auto')
                                <img class="w-full" src="{{ $more->img }}" alt="{{ $more->title }}"
                                    title="{{ $more->title }}">
                            @else
                                <img class="w-full" src="{{ route('file', ['blogs', $more->img]) }}"
                                    alt="{{ $more->title }}" title="{{ $more->title }}">
                            @endif
                        </div>
                        <div class="w-full mt-2 text-sm relative font-medium capitalize">
                            <h3>
                                @if ($more->type !== 'auto')
                                    <a href="{{ route('blog-detail', [$more->slug]) }}"
                                        >
                                        {{ $more->title }}
                                    </a>
                                @else
                                    <a href="{{ $more->slug }}" target="_blank" rel="noopener noreferrer nofollow"
                                        >
                                        {{ $more->title }}
                                    </a>
                                @endif
                            </h3>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
