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
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">2</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">3</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
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

            <div class="w-full flex justify-center">
                <div class="w-20 h-20 bg-white rounded-full">
                    <img src="{{ asset('public/assets/imgs/logo.png') }}" alt="img" class="min-h-full min-w-full">
                </div>
            </div>

            {{-- Greeting --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">CREDCRYPTO INSTALLER | <a style="color:red;" href="https://weadown.com" target="_blank">weadown.com</a></h3>
            </div>

            {{-- Terms of use --}}
            <div class="w-full text-[#dae0f5] p-2 md:p-5">
                <div class="w-full flex space-x-1 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="w-full text-base md:text-lg font-bold">Terms Of Use</h3>
                    </div>
                </div>
                <p class="font-medium text-sm md:text-base pl-6">
                    Thank you for purchasing a copy of CredHYIP, the best HYIP management script in the market. This script was carefully crafted by Traders for Traders.
                    <br>
                    Before proceeding to install this script, kindly <a class="text-lg underline hover:text-[#324152]" href="https://credcrypto.net">visit</a> to activate your copy and get your license key. Each purchase can only be used to activate a single license key. Beware that you can only use this script on a single domain at time
                    <br>
                    For support and existence, <a class="text-lg underline hover:text-[#324152]" href="https://credcrypto.net">visit</a> and create a support ticket.
                </p>

                <p class="font-medium text-sm md:text-base pl-6 mt-2">
                    Before proceeding to install this script, kindly <a class="text-lg underline hover:text-[#324152]" href="https://credcrypto.net">visit</a> to activate your copy and get your license key. Each purchase can only be used to activate a single license key. Beware that you can only use this script on a single domain at time
                    <br>
                    For support and existence, <a class="text-lg underline hover:text-[#324152]" href="https://credcrypto.net">visit</a> and create a support ticket.
                </p>
            </div>

            {{-- DOs and DON'Ts --}}
            <div class="w-full md:flex md:justify-evenly space-y-3 md:scroll-py-0 text-[#dae0f5] p-5">
                <div class="md:w-1/3">
                    <div class="w-full flex space-x-1 items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="w-full md:text-lg font-bold">DOs</h3>
                        </div>
                    </div>
                    <div class="font-medium text-sm md:text-base pl-5">
                        <ul class="list-disc">
                            <li>Use on one(1) domain only.</li>
                            <li>Modify or edit as you want.</li>
                            <li>Translate to your choice of language(s).</li>
                        </ul>
                    </div>
                </div>

                <div class="md:w-1/3">
                    <div class="w-full flex space-x-1 items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="w-full md:text-lg font-bold">DONT's</h3>
                        </div>
                    </div>
                    <div class="font-medium text-sm md:text-base pl-5">
                        <ul class="list-disc">
                            <li>Resell, distribute, give away, or trade by any means to any third party or individual.</li>
                            <li>Include this product into other products sold on any market or affiliate websites.</li>
                            <li>Use on more than one(1) domain.</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Disclaimer --}}
            <div class="w-full text-[#dae0f5] p-5">
                <div class="w-full flex space-x-1 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="w-full font-bold">DISCLAIMER</h3>
                    </div>
                </div>
                <p class="font-medium text-sm md:text-base pl-6">
                    We will not be responsible for any issues or error that occurs as a result of your modification of our code and/ database
                </p>
            </div>
        </div>
        <div class="mt-6 float-right">
            {{-- Next button --}}
            <div>
                <a href="{{ route('install.server') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection