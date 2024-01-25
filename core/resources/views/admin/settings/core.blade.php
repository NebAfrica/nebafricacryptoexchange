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

            {{--  setting pannel --}}

            @include('admin.includes.settings-panel')
            {{--  setting pannel ends --}}

            <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.core-validate') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="website_name">Website Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="website_name" id="website_name" value="{{ old('website_name') ?? websiteInfo('website_name') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('website_name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="general_currency">Currency:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="general_currency" id="general_currency">
                                    @foreach ($currencies as $currency)
                                    <option value="{{ strtoupper($currency['currency_code']) }}" @if (old('general_currency') ?? websiteInfo('general_currency')==strtoupper($currency['currency_code'])) selected @endif>{{ strtoupper($currency['currency_code']) .' | ' . $currency['currency_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('general_currency') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="website_email">Website Email:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="email" name="website_email" id="website_email" value="{{ old('website_email') ?? websiteInfo('website_email') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('website_email') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="website_phone">Website Phone No:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="website_phone" id="website_phone" value="{{ old('website_phone') ?? websiteInfo('website_phone_no') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('website_phone') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="website_address">Contact Address:</label>
                            <textarea class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="website_address" id="website_address" required>{!! old('website_address') ?? websiteInfo('website_contact_address') !!}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('website_address') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="theme">Theme:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="theme" id="theme" required>
                                    @foreach ($themes as $theme)
                                    <option value="{{ $theme }}" @if(websiteInfo('theme')==$theme) selected @endif>{{ ucwords(str_replace('_', ' ', $theme)) }}</option>
                                    @endforeach
                                    <option value="" disabled>More Themes Coming Soon</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="register_bonus">Register Bonus:</label>
                            <h6 class="text-xs text-blue-400">
                                set to 0 to disable
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="register_bonus" id="register_bonus" value="{{ old('register_bonus') ?? websiteInfo('register_bonus') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('register_bonus') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="ref_bonus">Referral Bonus (%):</label>
                            <h6 class="text-xs text-blue-400">
                                set to 0 to disable
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="ref_bonus" id="ref_bonus" value="{{ old('ref_bonus') ?? websiteInfo('ref_bonus') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('ref_bonus') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="decimal_places">Currency Decimal Places:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="decimal_places" id="decimal_places" value="{{ old('decimal_places') ?? websiteInfo('decimal_places') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('decimal_places') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection