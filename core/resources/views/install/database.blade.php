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
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
            </div>

            {{-- info --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Databse Configuration</h3>
            </div>

            {{-- Database config form --}}
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <form id="db-config-form" action="{{ route('install.database-validate') }}" method="POST" class="w-full md:w-3/4 grid grid-cols-1 md:grid-cols-2 md:gap-5">
                    @csrf

                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="db_connection" placeholder="Databse Connection" value="{{ old('db_connection') ?? 'mysql' }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium" placeholder="Database Connection">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_connection') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="db_host" placeholder="Databse Host" value="{{ old('db_host') ?? '127.0.0.1' }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_host') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="number" name="db_port" placeholder="Database Port" value="{{ old('db_port') ?? '3306' }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_port') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap items-stretch w-full relative">
                            <div class="flex -mr-px">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 px-3 whitespace-no-wrap text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="db_database" placeholder="Database" value="{{ old('db_database') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_database') {{ $message }} @enderror
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
                            <input type="text" name="db_username" placeholder="Username" value="{{ old('db_username') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_username') {{ $message }} @enderror
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
                            <input type="password" name="db_password" placeholder="Password" value="{{ old('db_password') }}" class="flex-shrink flex-grow leading-normal w-px flex-1 border h-10 rounded rounded-l-none px-3 relative focus:border-violet-400 focus:shadow focus:outline-none bg-transparent text-white font-medium">
                        </div>
                        <div class="p-1 text-red-600">
                            @error('db_password') {{ $message }} @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full flex justify-between mt-6">
            {{-- Prev button --}}
            <div>
                <a href="{{ route('install.permissions') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Next button --}}
            <div>
                <button type="button" id="db-config-form-submit-btn" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#db-config-form-submit-btn").click(function() {
        $("#db-config-form").submit()
    })
</script>

@endsection