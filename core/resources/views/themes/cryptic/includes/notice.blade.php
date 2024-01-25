@if (session()->has('fail') || session()->has('success'))
<div class="notice">
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-2/3 rounded-lg bg-[#131d2c] p-2 md:p-4">
                <div class="flex justify-between items-center ">
                    @if (session()->has('fail'))
                    <div>
                        <div class="w-full flex space-x-2  text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">Error! </b> {{ session()->get('fail') }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (session()->has('success'))
                    <div>
                        <div class="w-full flex space-x-2  text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-green-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">Success! </b> {{ session()->get('success') }}
                            </div>
                        </div>
                    </div>
                    @endif
    
                    <div>
                        <a role="button" class="flex justify-start items-center text-xs text-gray-400 hover:text-white close_btn">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
