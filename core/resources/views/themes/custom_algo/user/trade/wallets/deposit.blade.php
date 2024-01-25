<div class="full-popup">
    <div class="flex justify-center mt-10">      
    
    <div class="popup w-11/12 md:w-1/2 rounded-md bg-[#0e1726] text-[#ebedf2]">
        <div class="w-full">
            <div class="w-full flex justify-center">
                <div class="w-full p-2 md:p-4">
                    <div class="flex justify-between items-center">
                        <div id="segment-3">
                            {{-- Card header --}}
                            <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                <span id="wallet-action-heading"></span> <span class="text-green-600" id="wallet">{{ $wallet->symbol }}</span> {{ ct('wallet') }}
                            </h2>
                        </div>
        
                        <div>
                            <a role="button" id="close-popup" class="flex justify-start items-center text-xs text-red-600 hover:text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                
                            </a>
                        </div>
                    </div>
                    <div class="mt-2"></div>
                    <hr class="w-full border-b border-dotted border-gray-600 border mb-4">

                    {{--  disclaimer notification --}}
                    <div class="w-full p-6 md:p-10 flex justify-center" id="segment-2">
                        <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">{{ ct('Disclaimer') }}: </b> {{ ct('You are about to fund your') }} <b class="font-medium text-green-600"> {{ $wallet->symbol }}</b> {{ ct('wallet. The amount would be deducted from your Account Balance.') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center" id="segment-1">
                        <div class="w-full">
                            <div class="w-full flex justify-center">
                                <div>
                                    <div class="text-xl md:text-2xl font-bold text-center">
                                        <h1 id="funding-current-balance" data-bal="{{ round(user('account_bal'), 2) }}">{{ formatAmount(user('account_bal')) }}</h1>
                                    </div>
                                    <div class="text-xs md:text-sm text-center">
                                        <h6 class="text-orange-600">{{ ct('Fiat Balance') }}</h6>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="w-full  flex justify-center">
                                <div>
                                    <div class="text-xl md:text-2xl font-bold text-center">
                                        <h1 id="coin-balance" data-bal="{{ $wallet->balance }}">{{ number_format($wallet->balance, 8) }}</h1>
                                    </div>
                                    <div class="text-xs md:text-sm text-center">
                                        <h6 class="text-green-600">{{ $wallet->symbol }} {{ ct('Balance') }}</h6>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        <div class="w-full">
                            <div class="w-full my-6 md:my-10 flex justify-center space-x-2">
                                <div>
                                    <div class="text-xl md:text-2xl font-bold text-center">
                                        <h1 id="rate-symbol">1{{ $wallet->symbol }}</h1>
                                    </div>
                                </div>
        
                                <div>
                                    <div class="text-xl md:text-2xl font-bold text-center text-orange-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                        </svg>
                                    </div>
                                </div>
        
                                <div>
                                    
                                    <div class="text-xs md:text-sm text-center">
                                        <h3 id="funding-rate">{{ $price }}</h3>
                                    </div>
                                    <div class="text-xl md:text-2xl font-bold text-center">
                                        <h1>{{ websiteInfo("general_currency") }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="reloadSection">
                        <input type="hidden" id="reloadUrl" value="{{ request()->url() }}">
                    </div>

                    

                    

                    {{--  transfer form --}}
                    <div class="p-2 md:p-4">
                        <form action="" method="POST" id="funding-form">
                            <input type="hidden" id="action-type">
                            <div class="space-y-5">
                                {{--  amount input --}}
                                <div class="relative w-full">
                                    <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                                        {{ websiteInfo('general_currency') }}
                                    </span>
                                    <input name="amount" type="number" step='any' id="funding-amount"  required class="cred-hyip-theme1-text-input" placeholder="{{ ct('Enter amount to fund') }}">
                                </div>

                                <div class="relative w-full">
                                    <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold" id="symbol-change">
                                        {{ $wallet->symbol }}
                                    </span>
                                    <input name="total" type="text" id="funding-total"  class="cred-hyip-theme1-text-input" placeholder="" disabled>
                                </div>
                                
                            </div>

                            <div class="w-full my-5 px-5">
                                <button type="submit" id="funding-submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                    {{ ct('GO', 'u') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<style>
    .full-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1000;
        background: rgb(19, 29, 44, 0.7);
        display: none;
        
    }

    .popup {
        min-height: 400px;
    }

    
</style>