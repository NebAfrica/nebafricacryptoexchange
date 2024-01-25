@extends('themes.skeleton.layout.guest')

@section('content')

<div  >
    <div  >
        <div  >
            <div  >
                <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}" alt="Logo"  >

                <h3  >
                    Register
                </h3>
            </div>


            {{-- Form begins --}}
            <form action="{{ route('register-validate') }}" method="POST"  >
                @csrf
                <div  >
                    <div  >
                        <span  >
                            person
                        </span>
                        <input type="text" 
                            name="first_name" 
                            value="{{ old('first_name') }}"
                            placeholder="First Name" 
                              
                        >
                        <span>@error('first_name') {{ $message }} @enderror</span>
                    </div>

                    <div  >
                        <span  >
                            person
                        </span>
                        <input type="text" 
                            name="last_name" 
                            placeholder="Last Name" 
                            value="{{ old('last_name') }}"
                             
                        >
                        <span>@error('last_name') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            alternate_email
                        </span>
                        <input type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Email Address" 
                             
                        >
                        <span>@error('email') {{ $message }} @enderror</span>
                    </div>

                    <div  >
                        <span  >
                            call
                        </span>
                        <input type="tel" 
                            name="phone_no"
                            value="{{ old('phone_no') }}" 
                            placeholder="Phone Number" 
                             
                        >
                        <span>@error('phone_no') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            home
                        </span>
                        <textarea name="street_address" rows="3" placeholder="Current Address"  >{{ old('street_address') }}</textarea>
                        <span>@error('street_address') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            map
                        </span>
                        <input type="text" 
                            name="state" 
                            value="{{ old('state') }}"
                            placeholder="State/Region" 
                             
                        >
                        <span>@error('state') {{ $message }} @enderror</span>
                    </div>

                    <div  >
                        <span  >
                            flag
                        </span>
                        <select name="country"  >                            
                            <option value="" @if(!old('country')) selected @endif disabled>Select Country</option>
                            @if (isset($countries))
                                @foreach ($countries as $country)
                                    <option value="{{ $country['name'] }}" @if(old('country') == $country['name']) selected @endif>{{ $country['name'] }}</option>                
                                @endforeach                
                            @endif 
                            
                        </select>
                        <span>@error('country') {{ $message }} @enderror</span>
                        
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            account_circle
                        </span>
                        <select name="gender"  >
                            <option selected disabled>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="neutral">Neutral</option>
                        </select>
                        <span>@error('gender') {{ $message }} @enderror</span>
                    </div>

                    <div  >
                        <span  >
                            D.O.B
                        </span>
                        <input type="date" 
                            name="dob" 
                            value="{{ old('dob') }}"
                            placeholder="Date Of Birth" 
                             
                        >
                        <span>@error('dob') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            emoji_people
                        </span>
                        @if (session()->has('ref_code'))
                            <input type="text" name="referred_by" value="{{ session()->get('ref_code') }}" readonly  >
                        @else
                            <input type="text" name="referred_by" placeholder="Referred By:" value="{{ old('ref_code') }}"   >
                        @endif
                    </div>
                </div>

                <div  >
                    <div  >
                        <span  >
                            password
                        </span>
                        <input type="password" 
                            name="password" 
                            placeholder="Password" 
                             
                        >
                        <span>@error('password'){{ $message }} @enderror</span>
                    </div>

                    <div  >
                        <span  >
                            password
                        </span>
                        <input type="password" 
                            name="password_confirmation" 
                            placeholder="Confirm Password" 
                             
                        >
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
                            app_registration
                        </span>
                        <input type="submit" value="Sign up"  >
                    </div>
    
                    <div>
                        <a href="{{ route('login') }}"  >Already Have Account? Login</a>
                    </div>
                </div>
            </form>
            {{-- Form end --}}
        </div>
    </div>
</div>

@endsection