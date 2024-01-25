@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Security and OTP Setting
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
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.security-otp-validate') }}" method="post">

                    @csrf
                    
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="recaptcha_site_key">Recaptcha Site Key:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="recaptcha_site_key" id="recaptcha_site_key" value="{{ old('recaptcha_site_key') ?? env('RECAPTCHA_SITE_KEY') }}" required>
                        </div>

                        <span class="p-1 text-red-600">
                            @error('recaptcha_site_key') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="recaptcha_secret_key">Recaptcha Secret Key:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="recaptcha_secret_key" id="recaptcha_secret_key" value="{{ old('recaptcha_secret_key') ?? env('RECAPTCHA_SECRET_KEY') }}" required>
                        </div>

                        <span class="p-1 text-red-600">
                            @error('recaptcha_secret_key') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Google Recaptcha:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="google_captcha" class="hidden-radio toggle @if(old('google_captcha') ?? websiteInfo('google_captcha')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="google_captcha" id="google_captcha" @if(old('google_captcha') ?? websiteInfo('google_captcha')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                            
                                        </div>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('google_captcha') {{ $message }} @enderror
                                    </span>
                                </div>
            
                            </div>

                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Email Verification:</label>                            
                                        <div class="flex mt-1 items-center">
                                            <label for="email_verification" class="hidden-radio toggle @if(old('email_verification') ?? websiteInfo('email_verification')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="email_verification" id="email_verification" @if(old('email_verification') ?? websiteInfo('email_verification')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('email_verification') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">KYC Verification:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="id_verification" class="hidden-radio toggle @if(old('id_verification') ?? websiteInfo('id_verification')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="id_verification" id="id_verification" @if(old('id_verification') ?? websiteInfo('id_verification')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('id_verification') {{ $message }} @enderror
                                    </span>
                                </div>
            
                            </div>

                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Transfer OTP:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="transfer_otp" class="hidden-radio toggle @if(old('transfer_otp') ?? websiteInfo('transfer_otp')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="transfer_otp" id="transfer_otp" @if(old('transfer_otp') ?? websiteInfo('transfer_otp')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('transfer_otp') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Withdrawal OTP:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="withdrawal_otp" class="hidden-radio toggle @if(old('withdrawal_otp') ?? websiteInfo('withdrawal_otp')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="withdrawal_otp" id="withdrawal_otp" @if(old('withdrawal_otp') ?? websiteInfo('withdrawal_otp')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('withdrawal_otp') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Loan OTP:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="loan_otp" class="hidden-radio toggle @if(old('loan_otp') ?? websiteInfo('loan_otp')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="loan_otp" id="loan_otp" @if(old('loan_otp') ?? websiteInfo('loan_otp')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('loan_otp') {{ $message }} @enderror
                                    </span>
                                </div>
            
                            </div>
                        </div>    
                    </div> 
                    
                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Login OTP - User:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="login_otp_user" class="hidden-radio toggle @if(old('login_otp_user') ?? websiteInfo('login_otp_user')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="login_otp_user" id="login_otp_user" @if(old('login_otp_user') ?? websiteInfo('login_otp_user')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('login_otp_user') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-4">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Login OTP - Admin:</label>
                                        <div class="flex mt-1 items-center">
                                            <label for="login_otp_admin" class="hidden-radio toggle @if(old('login_otp_admin') ?? websiteInfo('login_otp_admin')== 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="login_otp_admin" id="login_otp_admin" @if(old('login_otp_admin') ?? websiteInfo('login_otp_admin')== 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('login_otp_admin') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>    
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

@section('script')

<script>
    $(document).ready(function() {
        // Act on load
        $.each($(".action-box"), function(index, val) {
            let disabledText = $(this).siblings(".disabled-status");
            let enabledText = $(this).siblings(".enabled-status");
            if ($(this).is(':checked')) {
                disabledText.addClass("hidden");
                enabledText.removeClass("hidden");
            } else {
                disabledText.removeClass("hidden");
                enabledText.addClass("hidden");
            }
        })

        // Toogle text on checkbox change
        $(".action-box").on("change", function(e) {
            let disabledText = $(this).siblings(".disabled-status");
            let enabledText = $(this).siblings(".enabled-status");

            if ($(this).is(':checked')) {
                disabledText.addClass("hidden");
                enabledText.removeClass("hidden");
            } else {
                disabledText.removeClass("hidden");
                enabledText.addClass("hidden");
            }
        });
    });
</script>

@endsection