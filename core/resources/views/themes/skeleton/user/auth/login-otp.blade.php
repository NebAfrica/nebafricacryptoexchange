@extends('themes.skeleton.layout.guest')

@section('content')

<div  >
    <div  >
        <div  >
            <div  >
                <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo"  >
            </div>
            <h3  >
                Login OTP
            </h3>


            {{-- Form begins --}}
            <form action="{{ route('login-otp-validate') }}" method="POST"  >
                @csrf
                

                <div  >
                    <div  >
                        <span  >
                            lock
                        </span>
                        <input type="text" name="otp" placeholder="OTP"   >
                        <span>@error('otp') {{ $message }} @enderror </span>
                    </div>
                </div>
                <div  >
                    <div  >
                        <span  >
                            login
                        </span>
                        <input type="submit" value="Verify"  >
                    </div>
                </div>

                
            </form>

            {{-- Forgot pass and regiater --}}
            <div  >
                

                <div>
                    <a role="button"  >Resend OTP</a>
                </div>
            </div>
            {{-- Form end --}}

            
        </div>
    </div>
</div>



@endsection