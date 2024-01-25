@extends('themes.skeleton.layout.guest')

@section('content')


<div  >
    <div  >
        <div  >
            <div  >
                <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo"  >
            </div>
            <h3  >
                Login
            </h3>


            {{-- Form begins --}}
            <form action="{{ route('login-validate') }}" method="POST"  >
                @csrf
                <div  >
                    <div  >
                        <span  >
                            mail
                        </span>
                        <input type="email" name="email" placeholder="Email"   value="{{ old('email') }}">
                        <span>@error('email') {{ $message }} @enderror </span>
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            lock
                        </span>
                        <input type="password" name="password" placeholder="Password"  >
                        <span>@error('password') {{ $message }} @enderror </span>
                    </div>
                </div>

                @if (websiteInfo('google_captcha') == 'enabled')
                <div  >
                    <div  >
                        {!! htmlFormSnippet() !!}
                        <span>@error('g-recaptcha-response') {{ $message }} @enderror </span>
                    </div>
                </div>
                @endif

                

                <div  >
                    <div  >
                        <span  >
                            login
                        </span>
                        <input type="submit" value="Login"  >
                    </div>
                </div>
            </form>
            {{-- Form end --}}

            {{-- Forgot pass and regiater --}}
            <div  >
                <div>
                    <a href="{{ route('forgot-password') }}"  >Forgot password?</a>
                </div>

                <div>
                    <a href="{{ route('register') }}"  >Register</a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection