@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Delete Theme
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
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('admin.settings.theme-manager.themes') }}" title="Add Theme" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                {{-- disclaimer notification --}}
                <div class="w-full p-6 md:p-10 flex justify-center">
                    <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                        <div class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b class="font-medium">WARNING! </b> You are about to delete the {{ ucwords(str_replace('_', ' ', $theme_name)) }} theme, this action cannot be reversed. Enter your password to confirm deletion.
                        </div>
                    </div>
                </div>

                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.theme-manager.delete-theme-validate') }}" method="post">

                    @csrf
                    <input type="hidden" name="theme_name" value="{{ $theme_name }}">

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="password">Password:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="password" id="password" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('password') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="password_confirmation">Confirm Password:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="password_confirmation" id="password_confirmation" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('password_confirmation') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Delete Theme
                        </button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>
@endsection