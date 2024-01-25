@extends('themes.skeleton.layout.app')

@section('title')
    <div>
        <div>
            <div>
                <div>
                    <div>
                        {{--  Card header --}}
                        <h2>
                            Edit Profile
                        </h2>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
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
    <div>
        <div>
            <div>
                <div>
                    {{--  Card header --}}
                    <h6>
                        Account Information
                    </h6>
                </div>

                <hr>

                <form action="{{ route('user.account.general') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (user('id_verified') != 'verified')
                        <div>
                            <div>
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" id="first_name"
                                    value="{{ old('first_name') ?? user('first_name') }}">
                            </div>
                            <span>
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div>
                            <div>
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name"
                                    value="{{ old('last_name') ?? user('last_name') }}">
                            </div>
                            <span>
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div>
                            <div>
                                <label for="dob">Date Of Birth:</label>
                                <input type="date" name="dob" id="dob" value="{{ old('dob') ?? user('dob') }}">
                            </div>
                            <span>
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    @else
                        <div>
                            <div>
                                <label for="first_name">First Name:</label>
                                <input type="text" value="{{ old('first_name') ?? user('first_name') }}" disabled>
                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="last_name">Last Name:</label>
                                <input type="text" value="{{ old('last_name') ?? user('last_name') }}" disabled>
                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="dob">Date Of Birth:</label>
                                <input type="date" disabled
                                    value="{{ old('dob') ?? date('m/d/Y', strtotime(user('dob'))) }}">
                            </div>
                        </div>
                    @endif

                    <div>
                        <div>
                            <label for="phone_no">Phone No:</label>
                            <input type="tel" name="phone_no" id="phone_no"
                                value="{{ old('phone_no') ?? user('phone_no') }}">
                        </div>
                        <span>
                            @error('phone_no')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="street_address">Address:</label>
                            <textarea name="street_address" id="street_address">{{ old('street_address') ?? user('street_address') }}</textarea>
                        </div>
                        <span>
                            @error('street_address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="phone_no">State/Region:</label>
                            <input type="text" name="state" id="state"
                                value="{{ old('state') ?? user('state') }}">
                        </div>
                        <span>
                            @error('state')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="country">Country:</label>
                            <select name="country">
                                @if (isset($countries))
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['name'] }}"
                                            @if (old('country') ?? user('country') == $country['name']) selected @endif>{{ $country['name'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span>
                            @error('country')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="profile_picture">Profile Picture:</label>
                            <label for="profile_picture">
                                <h5>select image</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture">
                        </div>
                        <span>
                            @error('profile_picture')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <button type="submit" href="{{ route('user.id.upload') }}">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div>
        <div>
            <div>
                <div>
                    {{--  Card header --}}
                    <h6>
                        Change Password
                    </h6>
                </div>

                <hr>

                <form action="{{ route('user.account.password') }}" method="POST">
                    @csrf

                    <div>
                        <div>
                            <label for="old_password">Old Password:</label>
                            <input type="password" name="old_password" id="old_password" required>
                        </div>
                        <span>
                            @error('old_password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="password">New Password:</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <span>
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <div>
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required>
                        </div>
                        <span>
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <button type="submit" href="{{ route('user.id.upload') }}">
                            Change password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
