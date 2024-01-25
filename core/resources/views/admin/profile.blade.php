@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        My Account
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
            <div class="">
                <div>
                    <h3 class="font-medium capitalize">Profile Overview</h3>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-2">

            <div class="w-full flex justify-center">
                <div class="">
                    <div class="w-36 h-36 rounded-full">
                        <img src="{{ route('file', ['admin', admin('profile_photo')])  }}" alt="">
                    </div>
                    <h3 class="text-[#bfc9d4] font-medium text-base md:text-lg mt-2">{{ admin('first_name') .' '.admin('last_name') }}</h3>
                    <h4 class="text-[#bfc9d4] text-sm md:text-base mt-1">{{ admin('email') }}</h4>
                </div>
            </div>

            <div class="w-full md:px-2">
                <div class="w-full flex justify-center items-center space-x-3 lg:space-x-5 mt-10 mb-5">
                    <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" role="button" id="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <h6>Edit Account</h6>
                    </a>
                    <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" role="button" id="password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <h6>Change Password</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    //Profile
    $(document).ready(function() {
        $("#edit").click(function() {
            Swal.fire({
                title: 'Update Profile',
                html: `
                    <form class="space-y-6" action="{{ route('admin.account.general') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="relative">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    account_box
                                </span>
                                <input class="cred-hyip-theme1-text-input" type="text" name="first_name" id="first_name" value="{{ old('first_name') ?? admin('first_name') }}" placeholder="Enter first name" required>
                                <span>@error('first_name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="relative">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    account_box
                                </span>
                                <input class="cred-hyip-theme1-text-input" type="text" name="last_name" id="last_name" value="{{ old('last_name') ?? admin('last_name') }}" placeholder="Enter last name" required>
                                <span>@error('last_name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="relative">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    photo_camera
                                </span>
                                <input class="cred-hyip-theme1-text-input" type="file" name="profile_photo" id="profile_photo">
                                <span>@error('profile_photo') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        
                        <hr class="w-full border-b border-dotted border-gray-600 border">

                        <div class="w-full mt-5 px-5 float-left">
                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save changes
                            </button>
                        </div>
                    </form>
                `,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                background: "#0e1726",
                color: "#d1d5db",
                
            });
        });
    });


    //password
    $(document).ready(function() {
        $("#password").click(function() {
            Swal.fire({
                title: 'Change Password',
                html: `
                    <form class="space-y-6" action="{{ route('admin.account.password') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1">
                            <div class="relative">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    lock
                                </span>
                                <input class="cred-hyip-theme1-text-input" type="password" name="password" placeholder="Enter password" required>
                                <span>@error('password') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="relative">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    lock
                                </span>
                                <input class="cred-hyip-theme1-text-input" type="password" name="password_confirmation" placeholder="Confirm password" required>
                                <span>@error('password') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        
                        <hr class="w-full border-b border-dotted border-gray-600 border">

                        <div class="w-full mt-5 px-5 float-left">
                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save changes
                            </button>
                        </div>
                    </form>
                `,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                background: "#0e1726",
                color: "#d1d5db",
                
            });
        });
    });
</script>
@endsection