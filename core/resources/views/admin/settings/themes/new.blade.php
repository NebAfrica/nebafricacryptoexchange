@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Create New Theme
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <div class="flex justify-end space-x-2">
                <div>
                    <a href="{{ route('admin.settings.theme-manager.themes') }}" title="Add Theme" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Active Themes</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.settings.theme-manager.exports') }}" title="Add Theme" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Exports</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-5">

            @if (session()->has('upload_errors'))
            {{-- disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Failed! </b> An error Occured. <br>
                        <b class="font-medium">ERROR LOG: </b> <br>
                        @foreach (session()->get('upload_errors') as $upload_error)
                        {{ $loop->iteration . '. ' . $upload_error}} <br>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.theme-manager.new-theme-validate') }}" method="post">
                    @csrf

                    <div class="w-full p-6 md:p-10 flex justify-center">
                        <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">HINT: </b> You are about to create a new theme, all required theme files would be generated automatically into the right folder. <br><br>
                                <b class="font-medium">Skeleton: </b> Select skeleton if you are developer looking to build your own custom theme, this will generate all the blades files required, assets files requird. The generated blade files will be without design, while the assets files will be blank. <br><br>
                                <b class="font-medium">Cryptic: </b> Select cryptic if you are looking to do minor modifications. It will generate new blade and asset files with current design of the default cryptic theme.
                            </div>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="theme_name">Theme Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="theme_name" id="theme_name" value="{{ old('theme_name') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme_name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="theme_bg_color">Background Color:</label>
                            <div class="w-16 h-16 rounded-full p-2 cred-hyip-theme1-bg">
                                <input class="rounded-full w-full h-full cred-hyip-theme1-bg transition-colors duration-200 transform focus:outline-none" type="color" name="theme_bg_color" id="theme_bg_color" value="{{ old('theme_bg_color') ?? '#060818' }}" required>
                            </div>                            
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme_bg_color') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="theme_status">Theme Status:</label>
                            <div class="">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="theme_status" id="theme_status" required>
                                    <option value="" disabled @if (!old('theme_status')) selected @endif>Please Select</option>
                                    <option value="active" @if (old('theme_status')=='active' ) selected @endif>Active</option>
                                    <option value="inactive" @if (old('theme_status')=='inactive' ) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme_status') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="type">Build From:</label>
                            <div class="">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="type" id="type" required>
                                    <option value="" disabled @if (!old('type')) selected @endif>Please Select</option>
                                    <option value="cryptic" @if (old('type')=='cryptic' ) selected @endif>Cryptic</option>
                                    <option value="skeleton" @if (old('type')=='skeleton' ) selected @endif>Skeleton</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme_status') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Theme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection