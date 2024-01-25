<div id="create-wallet-form" class="hidden">
    <div class="popup-form">
        <div class="w-full py-5">
            <div class="w-full flex justify-center">
                <div class="w-11/12 md:w-1/3 rounded-md bg-[#0e1726] p-2 md:p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            {{-- Card header --}}
                            <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                               {{ ct('Add New Wallet') }}
                            </h2>
                        </div>
                        <div>
                            <a role="button" data-toggle="create-wallet-form" class="popup-trigger-button flex justify-start items-center text-xs text-red-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </a>
                        </div>
                        
                    </div>

                    <hr class="w-full border-b border-dotted border-gray-600 border">


                    <table id="datatable-skeleton-table-2" class="text-[#bfc9d4] text-xs md:text-sm mt-5">
                        <thead>
                            <tr>
                                <th>{{ ct('Icon') }}</th>
                                <th>{{ ct('Symbol') }}</th>
                                <th>{{ ct('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trading_currencies as $currency)
                                <tr>
                                    <td class="font-medium">
                                        @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($currency->symbol) . '.svg'))
                                            <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($currency->symbol) . '.svg') }}" alt="{{ $currency->name }}"  width="50px" class="rounded-full">
                                        @else 
                                            <img src="{{ asset('public/assets/imgs/fallback.png') }}" alt="{{ $currency->name }}"  width="50px" class="rounded-full">
                                        @endif
                                    </td>
                                    <td class="pl-6 md:pl-10">
                                        {{ $currency->symbol }}
                                    </td>
                                    <td>
                                        <a role="button" data-symbol="{{ $currency->symbol }}" class="create-wallet-btn flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <span>{{ ct('Create') }}</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .popup-form {
        width: 100vw;
        height: 100vh;
        background: rgb(6, 8, 24, 0.9);
        z-index: 100;
        top: 0;
        left: 0;
        position: absolute;
    }
</style>