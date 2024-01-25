@extends('install.app')

@section('content')

<div class="w-full flex justify-center">
    <div class="w-11/12 md:w-3/4 mt-16 md:mt-9">
        {{-- Step indicator --}}
        <div class="w-full flex justify-center">
            <div class="w-full flex justify-center items-center">
                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">1</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">2</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">3</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">4</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">5</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">6</h2>
                </div>

            </div>
        </div>
        {{-- End step indicator --}}
    </div>
</div>



<div class="w-full flex justify-center">
    <div class="w-5/6 md:w-3/4 mt-7">
        <div class="w-full bg-[#5457b6] p-3 md:p-5 h-[29rem] md:h-[26rem] overflow-y-scroll">

            <div class="w-full flex justify-center mt-8 md:mt-0">
                <div class="w-20 h-20 bg-white rounded-full flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            {{-- info --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Website Setting</h3>
            </div>

            {{-- Database config form --}}
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <form id="site-config-form" action="{{ route('install.setting-validate') }}" method="POST" class="w-full md:w-3/4 grid grid-cols-1 md:grid-cols-2 md:gap-5">
                    @csrf

                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="website_name" placeholder="Website Name" value="{{ old('website_name')}}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('website_name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="website_url" placeholder="Website url" value="{{ old('website_url') ?? url('/')}}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('website_url') {{ $message }} @enderror
                        </div>
                    </div>
                    


                    <div class="md:col-span-2">
                        {{-- info --}}
                        <div class="w-full">
                            <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Admin Setting</h3>
                        </div>
                    </div>


                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="first_name" placeholder="first name" value="{{ old('first_name') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('first_name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="last_name" placeholder="last name" value="{{ old('last_name') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('last_name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </span>
                            </div>
                            <input type="email" name="email" placeholder="email" value="{{ old('email') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('email') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="password" name="password" placeholder="password" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('password') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="password" name="password_confirmation" placeholder="Confirm Passsword" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('password_confirmation') {{ $message }} @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full flex justify-between mt-6">
            {{-- Prev button --}}
            <div>
                <a href="{{ route('install.database') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Next button --}}
            <div>
                <button type="button" id="site-config-form-submit-btn" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#site-config-form-submit-btn").click(function() {
        $("#site-config-form").submit();
    });


</script>

@endsection