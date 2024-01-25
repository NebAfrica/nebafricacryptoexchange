@extends('themes.cryptic.layout.guest')

@section('content')

<div class="w-full h-full px-5">
    <div class="flex justify-center w-full h-screen items-center">
        <div class="w-full md:w-3/4 lg:w-2/6 cred-hyip-theme1-primary-card">
            <div class="flex justify-center items-center">
                <a href="/">
                    <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo"
                        class="cred-hyip-theme1-card-logo">
                </a>
            </div>
            <h3 class="text-xl text-center font-bold text-gray-300">
                {{ ct('Login OTP') }}
            </h3>


            {{-- Form begins --}}
            <form action="{{ route('login-otp-validate') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6">
                @csrf
                

                <div class="grid grid-cols-1">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            lock
                        </span>
                        <input type="text" name="otp" placeholder="OTP"  class="cred-hyip-theme1-text-input">
                        <span>@error('otp') {{ $message }} @enderror </span>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-5">
                    <div class="relative">
                        <span class="cred-hyip-theme1-btn-icon material-icons">
                            login
                        </span>
                        <input type="submit" value="Verify" class="cred-hyip-theme1-primary-btn">
                    </div>
                </div>

                
            </form>

            {{-- Forgot pass and regiater --}}
            <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
                

                <div>
                    <a role="button" class="hover:text-purple-700 resend-otp">{{ ct('Resend OTP') }}</a>
                </div>
            </div>
            {{-- Form end --}}

            
        </div>
    </div>
</div>



@endsection