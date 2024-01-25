@extends('admin.layout.guest')

@section('content')


<div class="w-full h-full px-5">
    <div class="flex justify-center w-full h-screen items-center">
        <div class="w-full md:w-3/4 lg:w-2/6 cred-hyip-theme1-primary-card">
            <div class="flex justify-center items-center">
                <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo" class="cred-hyip-theme1-card-logo">
            </div>
            <h3 class="text-xl text-center font-bold text-gray-300">
               Reset Password
            </h3>


            {{-- Form begins --}}
            <form action="{{ route('admin.password-reset-validate') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            mail
                        </span>
                        <input type="email" name="email" placeholder="Email" class="cred-hyip-theme1-text-input" value="{{ old('email') }}">
                        <span>@error('email') {{ $message }} @enderror </span>
                    </div>
                </div>
                @if (websiteInfo('google_captcha') == 'enabled')
                <div class="grid grid-cols-1">
                    <div class="relative">
                        {!! htmlFormSnippet() !!}
                        <span>@error('g-recaptcha-response') {{ $message }} @enderror </span>
                    </div>
                </div>
                @endif

                

                <div class="grid grid-cols-1 mt-5">
                    <div class="relative">
                        <span class="cred-hyip-theme1-btn-icon material-icons">
                            login
                        </span>
                        <input type="submit" value="Reset" class="cred-hyip-theme1-primary-btn">
                    </div>
                </div>
            </form>
            {{-- Form end --}}

            {{-- Forgot pass and regiater --}}
            <div class="flex justify-between text-gray-300 text-xs font-semibold mt-4 px-5 lg:px-10">
                <div>
                    <a href="{{ route('admin.login') }}" class="hover:text-purple-700">Back TO Login</a>
                </div>

                
            </div>
        </div>
    </div>
</div>



@endsection


