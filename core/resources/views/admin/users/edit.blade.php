@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}'s profile
                    </h2>
                </div>
                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <form class="px-1 md:px-2 lg:px-4 space-y-6" action="{{ route('admin.users.edit-validate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="" value="{{ $user->id }}">

                <div class="grid grid-cols-2 gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            person
                        </span>
                        <input type="text" name="first_name" value="{{ old('first_name') ?? $user->first_name }}" placeholder="First Name" class="cred-hyip-theme1-text-input" required>
                        <span>@error('first_name') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            person
                        </span>
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') ?? $user->last_name }}" class="cred-hyip-theme1-text-input" required>
                        <span>@error('last_name') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            alternate_email
                        </span>
                        <input type="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="Email Address" class="cred-hyip-theme1-text-input" required>
                        <span>@error('email') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            call
                        </span>
                        <input type="tel" name="phone_no" value="{{ old('phone_no') ?? $user->phone_no }}" placeholder="Phone Number" class="cred-hyip-theme1-text-input" required>
                        <span>@error('phone_no') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            calendar_today
                        </span>
                        <input type="date" name="dob" value="{{ old('dob') ?? $user->dob }}" placeholder="Date of birth" class="cred-hyip-theme1-text-input" required>
                        <span>@error('dob') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            male
                        </span>
                        <select name="gender" class="cred-hyip-theme1-text-input" required>
                            <option disabled>Select Gender</option>
                            <option value="male" @if(old('gender') ?? $user->gender == 'male') selected @endif >Male</option>
                            <option value="female" @if(old('gender') ?? $user->gender == 'female') selected @endif > Female</option>
                        </select>
                        <span>@error('gender') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            home
                        </span>
                        <textarea name="street_address" rows="3" placeholder="Current Address" class="cred-hyip-theme1-textarea" required>{{ old('street_address') ?? $user->country }}</textarea>
                        <span>@error('street_address') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            map
                        </span>
                        <input type="text" name="state" value="{{ old('state') ?? $user->state }}" placeholder="State/Region" class="cred-hyip-theme1-text-input" required>
                        <span>@error('state') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            flag
                        </span>
                        <select name="country" class="cred-hyip-theme1-text-input" required>
                            <option value="" @if(!old('country')) selected @endif disabled>Select Country</option>
                            @if (isset($countries))
                            @foreach ($countries as $country)
                            <option value="{{ $country['name'] }}" @if(old('country') ?? $user->country == $country['name']) selected @endif>{{ $country['name'] }}</option>
                            @endforeach
                            @endif

                        </select>
                        <span>@error('country') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            verified
                        </span>
                        <select name="email_verified" class="cred-hyip-theme1-text-input" required>
                            <option disabled>Select email verification status</option>
                            <option value="pending" @if(old('email_verified') ?? $user->email_verified == 'pending') selected @endif >Pending</option>
                            <option value="verified" @if(old('email_verified') ?? $user->email_verified == 'verified') selected @endif > Verified</option>
                        </select>
                        <span>@error('email_verified') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            verified
                        </span>
                        <select name="id_verified" class="cred-hyip-theme1-text-input" required>
                            <option disabled>Select id verification status</option>
                            <option value="pending" @if(old('id_verified') ?? $user->id_verified == 'pending') selected @endif >Pending</option>
                            <option value="verified" @if(old('id_verified') ?? $user->id_verified == 'verified') selected @endif > Verified</option>
                        </select>
                        <span>@error('id_verified') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-2">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            fact_check
                        </span>
                        <select name="status" class="cred-hyip-theme1-text-input" required>
                            <option disabled>Select email user status</option>
                            <option value="suspended" @if(old('status') ?? $user->status == 'suspended') selected @endif >Suspended</option>
                            <option value="active" @if(old('status') ?? $user->status == 'active') selected @endif > Active</option>
                        </select>
                        <span>@error('status') {{ $message }} @enderror</span>
                    </div>

                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            security
                        </span>
                        <select name="g2fa" class="cred-hyip-theme1-text-input" required>
                            <option disabled>Select user 2FA status</option>
                            <option value="enabled" @if(old('g2fa') ?? $user->g2fa == 'enabled') selected @endif >Enabled</option>
                            <option value="disabled" @if(old('g2fa') ?? $user->g2fa == 'disabled') selected @endif > Disabled</option>
                        </select>
                        <span>@error('g2fa') {{ $message }} @enderror</span>
                    </div>
                </div>

                {{-- attachment btn  --}}
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-center space-x-2">
                        <div>
                            <label title="click to add attachments" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="profile_picture">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <h5>Upload profile picture</h5>
                            </label>
                            <input class="hidden attachment-input" type="file" name="profile_picture" id="profile_picture">
                        </div>
                        <div class="attachment-list">
                        </div>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('profile_picture') {{ $message }} @enderror
                    </span>
                </div>

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".attachment-input").change(function() {
        // first empty whatever is innit
        $(".attachment-list").html("")
    })

    $(".attachment-input").change(function() {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            if (names.length < 1)
                names.push($(this).get(0).files[i].name);
            else {
                names.push(", " + $(this).get(0).files[i].name);

            }
        }

        // let chosenDoc = $(this).val().split('\\').pop()
        $(".attachment-list").append(names);
    });
</script>

@endsection