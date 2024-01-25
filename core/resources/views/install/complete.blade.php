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
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            {{-- info --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Final Step: Don't Skip</h3>
            </div>

            {{-- permissions list & check --}}
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <form action="{{ route('install.complete-validate') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6">
                    @csrf

                    <h3 class="font-medium">Installation Complete</h3>

                    <p>You have successfully activated your CredHYIP Script. Click on the EXECUTE button to finish the installation process</p>

                    <div>
                        {{-- submit button --}}
                        <input type="submit" value="Execute" class="trigger uppercase cursor-pointer bg-[#333581] hover:bg-[#c3c4ef] text-white font-semibold px-8 pt-2 pb-3 rounded-md">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





















<div class="w-full h-full px-5">
    <div class="flex justify-center w-full h-screen items-center">
        <div class="w-full md:w-3/4 lg:w-2/6 cred-hyip-theme1-primary-card">

            <h3 class="text-xl text-center font-bold text-gray-300">
                <span>1</span> - <span>2</span> - <span>3</span> - <span>4</span> - <span>5</span> - <span style="color: blue">6</span>
            </h3>

            <div>
                <h2> Final Step: Don't Skip </h2>

                <form action="{{ route('install.complete-validate') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6">
                    @csrf

                    <h3>Installation Complete</h3>

                    <p>You have successfully activated your CredHYIP Script. Click on the login button to finish the installation process</p>




                    <div class="grid grid-cols-1 mt-5">
                        <div class="relative">
                            <span class="cred-hyip-theme1-btn-icon material-icons">
                                start
                            </span>
                            <input type="submit" value="Login" class="cred-hyip-theme1-primary-btn">
                        </div>
                    </div>
                </form>

            </div>

        </div>


    </div>
</div>



@endsection