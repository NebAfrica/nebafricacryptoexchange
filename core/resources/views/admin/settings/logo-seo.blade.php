@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Core Settings
                        </h2>
                    </div>

                    <div>
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

                {{--  setting pannel --}}

                @include('admin.includes.settings-panel')
                {{--  setting pannel ends --}}

                <div class="p-2 md:p-4">
                    <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.logo-seo-validate') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium w-28 overflow-hidden" for="logo">Logo [150x150]:</label>
                                <label
                                    class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                    for="logo">
                                    <span id="logo-preview" class="uploadIcon w-32 h-32  flex justify-center items-center"
                                        style="background-image: url({{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}); background-size: contain; background-repeat: no-repeat;">
                                        <span class="bg-gray-500 border p-2 text-white rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <input class="hidden" type="file" accept="image/*" name="logo" id="logo"
                                    data-preview="logo-preview">
                            </div>
                            <span class="p-1 text-red-600">
                                @error('logo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium w-28 overflow-hidden" for="logo_rec">Logo [300x100]:</label>
                                <label
                                    class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                    for="logo_rec">
                                    <span id="logo-rec-preview"
                                        class="uploadIcon w-64 h-32  flex justify-center items-center"
                                        style="background-image: url({{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}); background-size: contain; background-repeat: no-repeat;">
                                        <span class="bg-gray-500 border p-2 text-white rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <input class="hidden" type="file" accept="image/*" name="logo_rec" id="logo_rec"
                                    data-preview="logo-rec-preview">
                            </div>
                            <span class="p-1 text-red-600">
                                @error('logo_rec')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium w-28 overflow-hidden" for="favicon">Favicon [32x32]:</label>
                                <label
                                    class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                    for="favicon">
                                    <span id="favicon-preview" class="uploadIcon w-16 h-16 flex justify-center items-center"
                                        style="background-image: url({{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}); background-size: contain; background-repeat: no-repeat;">
                                        <span class="bg-gray-500 border p-2 text-white rounded-full">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <input class="hidden" type="file" accept="image/*" name="favicon" id="favicon"
                                    data-preview="favicon-preview">
                            </div>
                            <span class="p-1 text-red-600">
                                @error('favicon')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium" for="description">SEO Keywords:</label>
                                <textarea cols="30" rows="3"
                                    class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    name="keywords" id="keywords" required>{!! old('keywords') ?? json_decode(websiteInfo('meta'))->keywords !!}</textarea>

                            </div>
                            <span class="p-1 text-red-600">
                                @error('keywords')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium" for="description">SEO Description:</label>
                                <textarea cols="30" rows="3"
                                    class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    name="description" id="description" required>{!! old('description') ?? json_decode(websiteInfo('meta'))->description !!}</textarea>

                            </div>
                            <span class="p-1 text-red-600">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                            <div class="w-full flex items-baseline space-x-1">
                                <label class="font-medium w-28 overflow-hidden" for="banner">SEO and Social Banner
                                    [1200x630]:</label>
                                <label
                                    class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                    for="banner">
                                    <span id="banner-preview"
                                        class="uploadIcon w-full h-28 md:h-64 flex justify-center items-center"
                                        style="background-image: url({{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}); background-size: contain; background-repeat: no-repeat;">
                                        <span class="bg-gray-500 border p-2 text-white rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <input class="hidden" type="file" accept="image/*" name="banner" id="banner"
                                    data-preview="banner-preview">
                            </div>
                            <span class="p-1 text-red-600">
                                @error('banner')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm hidden-checkbox">
                            <div class="w-full">
                                <label for="" class="font-medium">Robots & Indexing:</label>
                                <div class="flex mt-1 items-center">
                                    <label for="robots"
                                        class="hidden-radio toggle @if (old('robots') ?? json_decode(websiteInfo('meta'))->robots == 'all') toggle--on @else toggle--off @endif"></label>
                                    <input type="hidden" name="robots" id="robots"
                                        @if (old('robots') ?? json_decode(websiteInfo('meta'))->robots == 'all') value="enabled" @else value="disabled" @endif
                                        required>
                                </div>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('robots')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="w-full my-5 px-5">
                            <button type="submit"
                                class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection
