@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        SMTP Setting
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
                <form class="mt-2 p-2 md:p-4 grid grid-cols-1 md:grid-cols-2 gap-3" action="{{ route('admin.settings.email-config-validate') }}" method="post">

                    @csrf
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="email_queue">Queue Emails:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="email_queue" id="email_queue" required>
                                    <option value="enabled" @if (old('email_queue') ?? websiteInfo('email_queue') =='enabled' ) selected @endif>Enabled</option>
                                    <option value="disabled" @if (old('email_queue') ?? websiteInfo('email_queue') =='disabled' ) selected @endif>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('email_queue') {{ $message }} @enderror
                        </span>
                    </div>


                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_host">SMTP Host:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="smtp_host" id="smtp_host" value="{{ old('smtp_host') ?? env('MAIL_HOST') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_host') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_port">SMTP Port:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="smtp_port" id="smtp_port" value="{{ old('smtp_port') ?? env('MAIL_PORT') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_port') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_encryption">SMTP Encryption:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="smtp_encryption" id="smtp_encryption" required>
                                    <option value="ssl" @if (old('smtp_encryption') ?? env('MAIL_ENCRYPTION')=='ssl' ) selected @endif>SSL</option>
                                    <option value="tls" @if (old('smtp_encryption') ?? env('MAIL_ENCRYPTION')=='tls' ) selected @endif>TLS</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_encryption') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_username">SMTP Username:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="smtp_username" id="smtp_username" value="{{ old('smtp_username') ?? env('MAIL_USERNAME') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_username') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_password">SMTP Password:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="smtp_password" id="smtp_password" value="{{ old('smtp_password') ?? env('MAIL_PASSWORD') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_password') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_from_address">From Email:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="email" name="smtp_from_address" id="smtp_from_address" value="{{ old('smtp_from_address') ?? env('MAIL_FROM_ADDRESS') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_from_address') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="smtp_from_name">From Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="smtp_from_name" id="smtp_from_name" value="{{ old('smtp_from_name') ?? env('MAIL_FROM_NAME') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('smtp_from_name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save
                        </button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>
@endsection