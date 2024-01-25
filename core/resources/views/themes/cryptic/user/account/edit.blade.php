@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('Edit Profile', 'c') }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="w-full flex justify-start items-baseline space-x-2">
                {{--  Card header --}}
                <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                    {{ ct('Account Information', 'c') }}
                </h6>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <form class="w-full mt-2 p-2 md:p-4 space-y-4" action="{{ route('user.account.general') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (user('id_verified') != 'verified')
                <div class="text-[#bfc9d4] text-xs md:text-sm mb-1">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="first_name">{{ ct('First Name', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="first_name" id="first_name" value="{{ old('first_name') ?? user('first_name') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('first_name') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="last_name">{{ ct('Last Name', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="last_name" id="last_name" value="{{ old('last_name') ?? user('last_name') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('last_name') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="dob">{{ ct('Date Of Birth', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="date" name="dob" id="dob" value="{{ old('dob') ?? user('dob') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('dob') {{ $message }} @enderror
                    </span>
                </div>

                @else
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="first_name">{{ ct('First Name', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" value="{{ old('first_name') ?? user('first_name') }}" disabled>
                    </div>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="last_name">{{ ct('Last Name', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" value="{{ old('last_name') ?? user('last_name') }}" disabled>
                    </div>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="dob">{{ ct('Date Of Birth', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="date" disabled value="{{ old('dob') ?? date('m/d/Y', strtotime(user('dob'))) }}">
                    </div>
                </div>
                @endif

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="phone_no">{{ ct('Phone No', 'c') }}:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="tel" name="phone_no" id="phone_no" value="{{ old('phone_no') ?? user('phone_no') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('phone_no') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="street_address">{{ ct('Address', 'c') }}:</label>
                        <textarea class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="street_address" id="street_address">{{ old('street_address') ?? user('street_address') }}</textarea>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('street_address') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="phone_no">{{ ct('State', 'c') }}</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="state" id="state" value="{{ old('state') ?? user('state') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('state') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="country">{{ ct('Country', 'c') }}:</label>
                        <select class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="country">
                            @if (isset($countries))
                            @foreach ($countries as $country)
                            <option value="{{ $country['name'] }}" @if(old('country') ?? user('country')==$country['name']) selected @endif>{{ $country['name'] }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('country') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-28 overflow-hidden" for="profile_picture">{{ ct('Profile Picture', 'c') }}:</label>
                        <label class="font-medium py-1 flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer" for="profile_picture">
                            <h5>{{ ct('select image') }}</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <input class="hidden" type="file" name="profile_picture" id="profile_picture">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('profile_picture') {{ $message }} @enderror
                    </span>
                </div>

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
                        {{ ct('Save changes', 'c') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="w-full flex justify-start items-baseline space-x-2">
                {{--  Card header --}}
                <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                    Change Password
                </h6>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <form class="w-full mt-2 p-2 md:p-4 space-y-4" action="{{ route('user.account.password') }}" method="POST">
                @csrf

                <div class="text-[#bfc9d4] text-xs md:text-sm mb-1">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="old_password">Old Password:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="old_password" id="old_password" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('old_password') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="password">New Password:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="password" id="password" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('password') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="password_confirmation">Confirm Password:</label>
                        <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('password_confirmation') {{ $message }} @enderror
                    </span>
                </div>

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
                        Change password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection